<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            AuthorSeeder::class,
            CategorySeeder::class,
            TagSeeder::class,
            ServiceSeeder::class,
            SolutionSeeder::class,
            LocationSeeder::class,
            BlogSeeder::class,
            ProviderSeeder::class,
        ]);
    }
}
