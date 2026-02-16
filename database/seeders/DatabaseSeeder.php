<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Price;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ProcessStatusesSeeder::class,
        ]);

        Manufacturer::factory(15)->create();
        Product::factory(500)->create();
        Price::factory(5000)->create();
    }
}
