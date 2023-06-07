<?php

namespace App\Http\Controllers;

use App\Models\Artifact;
use Illuminate\Http\Request;

class ArtifactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Artifact::all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);

        $artifact = new Artifact();
        $artifact->name = $request->name;
        $artifact->description = $request->description;
        $artifact->price = $request->price;
        $artifact->artist_id = $request->user()->id;
        $artifact->save();

        return response()->json([
            'message' => 'Artifact created successfully',
            'artifact' => $artifact
        ], 201);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artifact $artifact)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);

        $artifact->name = $request->name;
        $artifact->description = $request->description;
        $artifact->price = $request->price;
        $artifact->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artifact $artifact)
    {
        $artifact->delete();
    }

    public function myArtifacts(Request $request)
    {
        return $request->user()->artifacts;
    }
}
