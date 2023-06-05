<?php

namespace App\Http\Controllers;

use App\Models\Verb;
use Illuminate\Http\Request;
use Inertia\Inertia;

class VerbController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $verbs = Verb::latest()->paginate(10);

        return Inertia::render('Verbs/Index', ['verbs' => $verbs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Verbs/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Verb::create(
            Request::validate([
                'verb' => ['required'],
                'sentences' => ['required'],
            ])
        );

        return Redirect::route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Verb  $verb
     * @return \Illuminate\Http\Response
     */
    public function show(Verb $verb)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Verb  $verb
     * @return \Illuminate\Http\Response
     */
    public function edit(Verb $verb)
    {
        return Inertia::render('Verbs/Edit', [
            'verb' => [
                'id' => $verb->id,
                'verb' => $verb->verb,
                'sentences' => $verb->sentences
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Verb  $verb
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Verb $verb)
    {
        $data = Request::validate([
            'verb' => ['required'],
            'sentences' => ['required'],
        ]);
        $verb->update($data);
        

        return Redirect::route('verbs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Verb  $verb
     * @return \Illuminate\Http\Response
     */
    public function destroy(Verb $verb)
    {
        $verb->delete();
        
        return Redirect::route('verbs.index');
    }
}
