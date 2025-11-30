<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Http\Controllers\Controller; 

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $games = Game::with('genres')->get();
        return response()->json($games);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'image_url' => 'nullable|string',
            'hours_played' => 'required|integer',
            'hours_total' => 'nullable|integer',
            'genres' => 'array', 
            'genres.*' => 'exists:genres,id' 
        ]);


        $game = Game::create($request->except('genres'));

        if ($request->has('genres')) {
            $game->genres()->attach($request->input('genres'));
        }
        return response()->json($game->load('genres'), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $game = Game::with('genres')->findOrFail($id);
        
        return response()->json($game);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $game = Game::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'image_url' => 'nullable|string',
            'hours_played' => 'sometimes|integer',
            'hours_total' => 'sometimes|integer',
            'genres' => 'array', 
            'genres.*' => 'exists:genres,id'
        ]);


        $game->update($request->except('genres'));


        if ($request->has('genres')) {
            $game->genres()->sync($request->input('genres'));
        }

        return response()->json($game->load('genres'));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $game = Game::findOrFail($id);
        $game->delete();

        return response()->json(null, 204);
    }
}
