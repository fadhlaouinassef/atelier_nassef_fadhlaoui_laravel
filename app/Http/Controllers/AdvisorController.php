<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdvisorController extends Controller
{
    public function show(Request $request)
    {
        $age = (int) $request->query('age');
        $interet = $request->query('interet');

        if ($interet !== null && ! is_string($interet)) {
            abort(422, 'Le paramètre interet doit être du texte.');
        }

        $interet = trim($interet ?? '');

        return view('show', compact('age', 'interet'));
    }
}
