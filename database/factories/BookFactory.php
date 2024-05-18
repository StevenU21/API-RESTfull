<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'author' => fake()->name(),
            'genre' => fake()->text(20),
            'publication_year' => fake()->date(),
            'description' => fake()->sentence(15),
            'rate' => fake()->randomFloat(1, 0, 5),
            'likes' => fake()->numberBetween(10, 1000)
        ];
    }
}
