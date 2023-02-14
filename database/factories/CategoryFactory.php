<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // kategori : Basketball, Football, Volleyball, Badminton, Tennis dan tidak boleh sama
            'name' => $this->faker->unique()->randomElement(['Basketball', 'Football', 'Volleyball', 'Badminton', 'Tennis', 'Bulutangkis', "Boxing"]),

        ];
    }
}
