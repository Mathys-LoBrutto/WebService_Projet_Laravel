<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArtisteController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\MusiqueController;
use App\Http\Controllers\StyleController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\FactureController;
use Illuminate\Support\Facades\DB;

// Infos utilisateur
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Connexion utilisateur
Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = \App\Models\User::where('email', $request->email)->first();

    if (! $user || ! \Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
        return response()->json([
            'message' => 'Identifiants incorrects.'
        ], 401);
    }

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'access_token' => $token,
        'token_type' => 'Bearer',
    ]);
});

// Déconnexion utilisateur
Route::post('/logout', function (Request $request) {
    // Supprime le token actuel de l'utilisateur connecté
    $request->user()->currentAccessToken()->delete();

    return response()->json([
        'message' => 'Déconnexion réussie (jeton supprimé).'
    ]);
})->middleware('auth:sanctum');

// Inscription utilisateur
Route::post('/register', [UserController::class, 'store']);

// Liste artistes
Route::get('/artistes', [ArtisteController::class, 'index']);

// Liste albums
Route::get('/albums', [AlbumController::class, 'index']);

// Liste musiques, gratuite uniquement si pas connecté, payante si connecté
Route::get('/musiques', [MusiqueController::class, 'index']);

// Liste styles
Route::get('/styles', [StyleController::class, 'index']);

// Liste playlists
Route::get('/playlists', [PlaylistController::class, 'index']);

// Liste factures
Route::get('/factures', [FactureController::class, 'index']);

// Créer playlist
Route::post('/playlists', [PlaylistController::class, 'store'])->middleware('auth:sanctum');

// Ajouter musique
Route::post('/playlists/{playlist}/ajouter-musique', [PlaylistController::class, 'ajouterMusique'])->middleware('auth:sanctum');

// Acheter musique
Route::post('/musiques/{musique}/acheter', [FactureController::class, 'acheter'])->middleware('auth:sanctum');

// Mes factures
Route::get('/mes-factures', [FactureController::class, 'mesFactures'])->middleware('auth:sanctum');

// Pivot musique_style
Route::get('/musique-style', function () {
    return response()->json(DB::table('musique_style')->get());
});

// Pivot musique_playlist
Route::get('/musique-playlist', function () {
    return response()->json(DB::table('musique_playlist')->get());
});