<?php

namespace Database\Factories;

use App\Models\Musique;
use App\Models\Album;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Musique>
 */
class MusiqueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titre' => fake()->text(50),
            'duree' => fake()->time(),
            'prix' => fake()->numberBetween(1, 10),
            'payant' => fake()->boolean(),
            'album_id' => Album::inRandomOrder()->first()->id,  
        ];
    }
}
