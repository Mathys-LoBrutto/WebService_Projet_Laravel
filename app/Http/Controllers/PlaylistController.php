<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Musique;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    /**
     * Liste toutes les playlists avec leur créateur (user) et leurs musiques associées.
     */
    public function index()
    {
        // Eager Loading : on charge le créateur (user) et les musiques de la playlist
        $playlists = Playlist::with(['user', 'musiques'])->get();

        return response()->json($playlists);
    }

    /**
     * Crée une nouvelle playlist pour l'utilisateur connecté.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom_playlist' => 'required|string|max:255',
        ]);

                // Grâce à Eloquent, crée la playlist en rattachant automatiquement le user_id
        $playlist = $request->user()->playlists()->create([
            'nom_playlist' => $request->nom_playlist,
        ]);

        return response()->json([
            'message' => 'Playlist créée avec succès.',
            'playlist' => $playlist
        ], 201);
    }

    /**
     * Ajoute une musique à une playlist (uniquement si achetée ou gratuite).
     */
    public function ajouterMusique(Request $request, Playlist $playlist)
    {
        // 1. Sécurité : Vérifier que la playlist appartient bien à l'utilisateur connecté
        if ($playlist->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Cette playlist ne vous appartient pas.'], 403);
        }

        $request->validate([
            'musique_id' => 'required|exists:musiques,id',
        ]);

        $musiqueId = $request->musique_id;
        $musique = Musique::find($musiqueId);

        // 2. Règle de gestion : Si la musique est payante, on vérifie l'achat
        if ($musique->payant) {
            $dejaAchete = $request->user()->musiquesAchetees()->where('musique_id', $musiqueId)->exists();

            if (!$dejaAchete) {
                return response()->json([
                    'message' => 'Vous devez acheter cette musique avant de pouvoir l\'ajouter à une playlist.'
                ], 403);
            }
        }

        // 3. Liaison : On évite d'ajouter deux fois la même musique dans la playlist
        if ($playlist->musiques()->where('musique_id', $musiqueId)->exists()) {
            return response()->json(['message' => 'Cette musique est déjà dans la playlist.'], 400);
        }

        // Ajoute le lien dans la table pivot 'musique_playlist'
        $playlist->musiques()->attach($musiqueId);

        return response()->json([
            'message' => 'Musique ajoutée avec succès à la playlist.'
        ]);
    }
}
