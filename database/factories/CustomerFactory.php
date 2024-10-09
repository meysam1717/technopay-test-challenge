<?php

namespace Database\Factories;

use App\Enums\UserRole;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{

    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'national_code' => '432000'.$this->faker->numberBetween(1000, 9999),
            'phone' => '0910'.$this->faker->numberBetween(1000000, 9999999),
        ];
    }

    public function viaNationalCode(string $nationalCode): static
    {
        return $this->state(fn (array $attributes) => [
            'national_code' => $nationalCode,
        ]);
    }

    public function viaPhone(string $phone): static
    {
        return $this->state(fn (array $attributes) => [
            'phone' => $phone,
        ]);
    }

}
