<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UsoInterno>
 */
class UsoInternoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->numberBetween(1, 1000),
            'producto_id' => $this->faker->numberBetween(1, 1000),
            'consulta_id' => $this->faker->numberBetween(1, 1000),
            'cantidad' => $this->faker->numberBetween(1, 1000),
            'created_at' => fake()->text(),
            'updated_at' => fake()->text(),
        ];
    }
}
