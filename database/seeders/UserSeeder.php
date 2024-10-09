<?php

namespace Database\Seeders;

use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    public function run(): void
    {

        UserFactory::new()->count(5)->create();
        UserFactory::new()->count(2)->admin()->create();

    }

}
