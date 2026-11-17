<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama' => fake()->words(2, true),
            'harga' => fake()->numberBetween(10000, 10000000),
            'stok' => fake()->numberBetween(1, 100),
        ];
    }
}