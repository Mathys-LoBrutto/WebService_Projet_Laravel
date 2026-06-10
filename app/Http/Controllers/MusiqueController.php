<?php

namespace App\Http\Controllers;

use App\Models\Musique;

class MusiqueController extends Controller
{
    /**
     * Liste toutes les musiques avec leur album et leurs styles associés.
     */
    public function index()
    {
        // On vérifie si l'utilisateur est connecté via Sanctum (renvoie null si visiteur anonyme)
        $user = auth('sanctum')->user();

        if ($user) {
            // Utilisateur connecté : il a accès à TOUTES les musiques
            $musiques = Musique::with(['album', 'styles'])->get();
        } else {
            // Visiteur anonyme : il n'a accès qu'aux musiques gratuites
            $musiques = Musique::with(['album', 'styles'])
                ->where('payant', false)
                ->get();
        }

        return response()->json($musiques);
    }
}
