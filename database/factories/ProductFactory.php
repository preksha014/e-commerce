<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            //
            'name' => $this->faker->word(), // Random product name
            'description' => $this->faker->sentence(10), // Random sentence as description
            'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL', 'XXL']), // Random size
            'color' => $this->faker->safeColorName(), // Random color name
            'price' => $this->faker->randomNumber(4), // Random price
            'quantity' => $this->faker->numberBetween(1, 100), // Random quantity between 1 and 100
            'status' => $this->faker->boolean(80), // 80% chance of being active (1)
            'slug' => Str::slug($this->faker->unique()->word()), // Unique slug
            'category_id' =>Category::factory(),
        ];
    }
}
