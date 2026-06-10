<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Musique;
use App\Models\Style;
use App\Models\Playlist;
use App\Models\User;

class AssociationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // On récupère toutes les données déjà créées
        $musiques = Musique::all();
        $styles = Style::all();
        $playlists = Playlist::all();
        $users = User::all();

        // 1. Liaison Musique <-> Style (Relation Classer)
        foreach ($musiques as $musique) {
            // On pioche entre 1 et 3 styles au hasard dans la liste
            $randomStyles = $styles->random(rand(1, 3));
            foreach ($randomStyles as $style) {
                DB::table('musique_style')->insert([
                    'musique_id' => $musique->id,
                    'style_id' => $style->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // 2. Liaison Musique <-> Playlist (Relation presente)
        foreach ($playlists as $playlist) {
            // On ajoute entre 3 et 8 musiques aléatoires dans chaque playlist
            $randomMusiques = $musiques->random(rand(3, 8));
            foreach ($randomMusiques as $musique) {
                DB::table('musique_playlist')->insert([
                    'playlist_id' => $playlist->id,
                    'musique_id' => $musique->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // 3. Liaison Musique <-> User (Relation Facturer)
        foreach ($users as $user) {
            // Chaque utilisateur achète entre 1 et 4 musiques aléatoirement
            $purchasedMusiques = $musiques->random(rand(1, 4));
            foreach ($purchasedMusiques as $musique) {
                DB::table('facturer')->insert([
                    'user_id' => $user->id,
                    'musique_id' => $musique->id,
                    'dateFacturation' => fake()->date(),
                    'prixFacturation' => $musique->prix, // Le prix de la musique achetée
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
