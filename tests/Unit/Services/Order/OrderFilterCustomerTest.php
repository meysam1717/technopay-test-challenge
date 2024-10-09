<?php

namespace Tests\Unit\Services\Order;

use App\Enums\OrderStatus;
use App\Models\Customer;
use App\Models\Order;
use App\Services\Order\Filter\OrderFilterCustomer;
use App\Services\Order\Filter\OrderFilterStatus;
use Database\Factories\CustomerFactory;
use Database\Factories\DTOs\OrderFilterDTOFactory;
use Database\Factories\OrderFactory;
use Tests\TestCase;

class OrderFilterCustomerTest extends TestCase
{

    /** @test */
    public function it_applies_status_filter_in_order()
    {

        $order = OrderFactory::new()
            ->for(CustomerFactory::new())
            ->create();

        $dto = OrderFilterDTOFactory::new()
            ->viaCustomerNationalCode($order->customer->national_code)
            ->create();

        $orderFilterCustomer = new OrderFilterCustomer();

        $orders = $orderFilterCustomer->apply(
            query: Order::query(),
            dto: $dto,
        )->get();

        $this->assertCount(1, $orders);
    }


    /** @test */
    public function it_does_not_return_any_orders_that_does_not_have_match_customer()
    {

        OrderFactory::new()
            ->for(CustomerFactory::new()->viaNationalCode('4320000000'))
            ->create();

        $dto = OrderFilterDTOFactory::new()
            ->viaCustomerNationalCode('4409999999')
            ->create();

        $orderFilterCustomer = new OrderFilterCustomer();

        $orders = $orderFilterCustomer->apply(
            query: Order::query(),
            dto: $dto,
        )->get();

        $this->assertCount(0, $orders);
    }

}
