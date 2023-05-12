<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\ReversoHelper;
use DOMDocument;
use DOMXPath;

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

        $conjugation = ReversoHelper::getConjugation($request->verb);

        return response()->json($conjugation, 200);
    }
}
