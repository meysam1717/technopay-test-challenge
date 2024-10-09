<?php

namespace Tests\Unit\Factories;

use App\Enums\OrderStatus;
use App\Services\Order\Filter\OrderFilterDTO;
use Database\Factories\DTOs\OrderFilterDTOFactory;
use Tests\TestCase;

class OrderFilterDTOFactoryTest extends TestCase
{


    /** @test */
    public function it_creates_dto_with_random_data()
    {
        $dto = OrderFilterDTOFactory::new()->create();

        $this->assertInstanceOf(OrderFilterDTO::class, $dto);

        $this->assertIsInt($dto->getMinAmount());
        $this->assertIsInt($dto->getMaxAmount());
        $this->assertIsString($dto->getCustomerNationalCode());
        $this->assertIsString($dto->getCustomerPhone());

        $this->assertContains($dto->getStatus(), OrderStatus::cases());
    }

    /** @test */
    public function it_creates_dto_with_accepted_status()
    {
        $dto = OrderFilterDTOFactory::new()->viaStatus(OrderStatus::ACCEPTED)->create();

        $this->assertEquals(OrderStatus::ACCEPTED, $dto->getStatus());
    }

    /** @test */
    public function it_creates_dto_with_specific_national_code()
    {
        $nationalCode = '4320000000';
        $dto = OrderFilterDTOFactory::new()->viaCustomerNationalCode($nationalCode)->create();

        $this->assertEquals($nationalCode, $dto->getCustomerNationalCode());
    }

    /** @test */
    public function it_creates_dto_with_specific_phone_number()
    {
        $phone = '09100000000';
        $dto = OrderFilterDTOFactory::new()->viaCustomerPhone($phone)->create();

        $this->assertEquals($phone, $dto->getCustomerPhone());
    }

    /** @test */
    public function it_creates_dto_with_min_amount()
    {
        $minAmount = 10;
        $dto = OrderFilterDTOFactory::new()->viaMinAmount($minAmount)->create();

        $this->assertEquals($minAmount, $dto->getMinAmount());
    }

    /** @test */
    public function it_creates_dto_with_max_amount()
    {
        $maxAmount = 20;
        $dto = OrderFilterDTOFactory::new()->viaMaxAmount($maxAmount)->create();

        $this->assertEquals($maxAmount, $dto->getMaxAmount());
    }

}
