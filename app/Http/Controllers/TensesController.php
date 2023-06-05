<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\ReversoHelper;
use DOMDocument;
use DOMXPath;
use Inertia\Inertia;
use App\Models\Verb;

class TensesController extends Controller
{
    /**
     * Process the request and return the response
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function conjugate(Request $request)
    {
        // Get Conjugation
        $verb        = Verb::where('verb', $request->verb)->first();

        if (!isset($verb)) {
            $conjugation = ReversoHelper::getConjugation($request->verb);

            Verb::create(['verb' => $request->verb, 'sentences' => json_encode($conjugation)]);
        } else {
            $conjugation = json_decode($verb->sentences);
        }

        return response()->json($conjugation, 200);
    }
    
    public function spellCheck($word = '')
    {
        return Inertia::render('SpellCheck', ['word' => $word]);
    }
}
