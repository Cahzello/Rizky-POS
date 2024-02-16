<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'price' => fake()->numberBetween(2999, 87999),
            'stock_level' => fake()->numberBetween(0, 30),
            'cost_price' => fake()->numberBetween(5999, 120999),
            'categories_id' => rand(1,5),
        ];
    }
}
