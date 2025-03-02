<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'name' => $this->faker->word(),
            'image' => 'images/product.png',
            'price' => $this->faker->randomFloat(2, 10, 500),
            'stock' => $this->faker->numberBetween(1, 100),
            'description' => $this->faker->sentence(),
        ];
    }
}
