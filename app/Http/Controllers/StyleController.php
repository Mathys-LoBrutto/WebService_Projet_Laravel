<?php

namespace App\Http\Controllers;

use App\Models\Style;

class StyleController extends Controller
{
    /**
     * Liste tous les styles musicaux.
     */
    public function index()
    {
        $styles = Style::all();

        return response()->json($styles);
    }
}
