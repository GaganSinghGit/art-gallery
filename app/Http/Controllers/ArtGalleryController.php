<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArtGalleryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        return response()->json([
            'message' => 'Art Gallery created successfully'
        ], 201);
    }
}
