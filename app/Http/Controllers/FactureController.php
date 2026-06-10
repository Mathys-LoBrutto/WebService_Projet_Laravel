<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Musique;
use Illuminate\Http\Request;

class FactureController extends Controller
{
    /**
     * Liste toutes les factures (liaisons utilisateurs <-> musiques).
     */
    public function index()
    {
        // On récupère le contenu brut de la table pivot 'facturer'
        $factures = DB::table('facturer')->get();

        return response()->json($factures);
    }

    /**
     * Renvoie uniquement les factures de l'utilisateur actuellement connecté.
     */
    public function mesFactures(Request $request)
    {
        // Récupère l'utilisateur connecté
        $user = $request->user();

        // Récupère les musiques qu'il a achetées via la relation 'musiquesAchetees'
        $factures = $user->musiquesAchetees;

        return response()->json($factures);
    }

    /**
     * Permet à l'utilisateur connecté d'acheter une musique.
     * Note : $musique est injecté automatiquement par Laravel via son ID (Route Model Binding)
     */
    public function acheter(Request $request, Musique $musique)
    {
        $user = $request->user();

        // 1. Vérifier si la musique est payante
        if (!$musique->payant) {
            return response()->json([
                'message' => 'Cette musique est gratuite, il n\'est pas nécessaire de l\'acheter.'
            ], 400);
        }

        // 2. Vérifie si une liaison (user_id <-> musique_id) existe déjà dans la table pivot 'facturer'
        // $user->musiquesAchetees() renvoie les lignes de la table facturer ou on a user_id = id de l'utilisateur connecté
        if ($user->musiquesAchetees()->where('musique_id', $musique->id)->exists()) {
            return response()->json([
                'message' => 'Vous avez déjà acheté cette musique.'
            ], 400);
        }

        // 3. Insère une ligne dans 'facturer' reliant automatiquement l'ID de l'user et l'ID de la musique
        $user->musiquesAchetees()->attach($musique->id, [
            'dateFacturation' => now()->toDateString(),
            'prixFacturation' => $musique->prix,
        ]);

        return response()->json([
            'message' => 'Musique achetée avec succès.',
            'musique' => $musique
        ], 201);
    }
}
