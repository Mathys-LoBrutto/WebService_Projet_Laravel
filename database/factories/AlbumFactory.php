<?php

namespace Database\Factories;

use App\Models\Album;
use App\Models\Artiste;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Album>
 */
class AlbumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titre'=>fake()->text(50),
            'artiste_id'=>Artiste::inRandomOrder()->first()->id,
        ];
    }
}
