<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artiste;

class ArtisteController extends Controller
{
    /**
     * Renvoie la liste de tous les artistes.
     */
    public function index()
    {
        $artistes = Artiste::all();

        return response()->json($artistes);
    }
}
