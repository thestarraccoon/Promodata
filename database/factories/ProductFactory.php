<?php

namespace Database\Factories;

use App\Models\Manufacturer;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'product_name' => $this->faker->words(3, true) . ' ' .
                $this->faker->randomElement(['Pro', 'Ultra', 'Max', 'Plus', 'SE']),
            'category_id' => $this->faker->numberBetween(1, 5),
            'manufacturer_id' => Manufacturer::inRandomOrder()->first()?->id ?? 1,
        ];
    }
}
