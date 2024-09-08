<?php

namespace App\Http\Controllers;

use App\Models\CategoriesModel;
use Illuminate\Http\Request;

class player extends Controller
{
    public function index()
    {

        $players = CategoriesModel::all();
        return response()->json($players);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
        ]);

        $player=player::create($validateData);
        return response()->json($player,201);
    }


    public function update(Request $request, Player $player)
    {
        $validatedData=$request->validate([
            'name'=>'required|string',
            'email'=>'required|string',
        ]);

        $player->update($validatedData);

        return response()->json($player,200);

    }

    public function destroy(Request$request,Player $player)
    {
        $player->delete();
        return response()->json(null, 204);
    }
}
