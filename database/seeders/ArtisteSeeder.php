<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Artiste;

class ArtisteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Génère 10 artistes avec de faux noms et prénoms réalistes
        Artiste::factory(10)->create();
        
    }
}
