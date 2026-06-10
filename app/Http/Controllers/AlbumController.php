<?php

namespace App\Http\Controllers;

use App\Models\Album;

class AlbumController extends Controller
{
    /**
     * Liste tous les albums avec leur artiste associé.
     */
    public function index()
    {
        // Eager Loading : on charge la relation 'artiste' pour l'inclure dans le JSON
        $albums = Album::with('artiste')->get();

        return response()->json($albums);
    }
}
