<?php

namespace Database\Seeders;

use Database\Factories\OrderFactory;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{

    public function run(): void
    {
        OrderFactory::new()->count(100)->create();
        OrderFactory::new()->count(50)->accepted()->create();
    }

}
