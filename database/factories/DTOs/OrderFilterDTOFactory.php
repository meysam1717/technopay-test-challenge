<?php

namespace Database\Factories\DTOs;

use App\Enums\OrderStatus;
use App\Services\Order\Filter\OrderFilterDTO;
use Database\Factories\NonModelFactory;

/**
 * @extends NonModelFactory<OrderFilterDTO>
 */
class OrderFilterDTOFactory extends NonModelFactory
{

    public function definition(): array
    {
        return [
            'status' => $this->faker()->randomElement(OrderStatus::cases()),
            'customerNationalCode' => '432'.$this->faker()->numberBetween(0000000, 9999999),
            'customerPhone' => '0910'.$this->faker()->numberBetween(0000000, 9999999),
            'minAmount' => $this->faker()->numberBetween(10000000, 20000000),
            'maxAmount' => $this->faker()->numberBetween(10000000, 20000000),
        ];
    }

    public function model(): string
    {
        return OrderFilterDTO::class;
    }

    public function viaStatus(OrderStatus $status): static
    {
        $this->states[] = fn(array $attributes) => ['status' => $status];
        return $this;
    }

    public function viaCustomerNationalCode(string $nationalCode): static
    {
        $this->states[] = fn(array $attributes) => ['customerNationalCode' => $nationalCode];
        return $this;
    }

    public function viaCustomerPhone(string $phone): static
    {
        $this->states[] = fn(array $attributes) => ['customerPhone' => $phone];
        return $this;
    }

    public function viaMinAmount(int $minAmount): static
    {
        $this->states[] = fn(array $attributes) => ['minAmount' => $minAmount];
        return $this;
    }

    public function withoutMinAmount(): static
    {
        $this->states[] = fn(array $attributes) => ['minAmount' => null];
        return $this;
    }

    public function viaMaxAmount(int $maxAmount): static
    {
        $this->states[] = fn(array $attributes) => ['maxAmount' => $maxAmount];
        return $this;
    }

    public function withoutMaxAmount(): static
    {
        $this->states[] = fn(array $attributes) => ['maxAmount' => null];
        return $this;
    }

}
