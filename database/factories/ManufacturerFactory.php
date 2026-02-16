<?php

namespace Database\Factories;

use App\Models\Manufacturer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Manufacturer>
 */
class ManufacturerFactory extends Factory
{
    protected $model = Manufacturer::class;
    public function definition(): array
    {
        return [
            'manufacturer_name' => $this->faker->company(),
        ];
    }
}
