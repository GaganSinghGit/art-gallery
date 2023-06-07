<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExhibitionRequest;
use App\Models\Exhibition;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExhibitionController extends Controller
{
    public function index(Request $request)
    {
        return Exhibition::all();
    }

    public function store(ExhibitionRequest $request)
    {
        $exhibition = new Exhibition();
        $exhibition->name = $request->get('name');
        $exhibition->start_time = new Carbon($request->get('startDate'));
        $exhibition->end_time = new Carbon($request->get('endDate'));
        $exhibition->save();
    }

    public function update(ExhibitionRequest $request, Exhibition $exhibition)
    {
        $exhibition->name = $request->get('name');
        $exhibition->start_time = new Carbon($request->get('startDate'));
        $exhibition->end_time = new Carbon($request->get('endDate'));
        $exhibition->save();
    }

    public function addArtifact(Request $request, Exhibition $exhibition)
    {
        $exhibition->artifacts()->attach($request->get('artifactId'));
        return response()->json([
            'message' => 'Artifact added to exhibition'
        ], 200);
    }

    public function getExhibitionsWithArtifacts()
    {
        return Exhibition::with('artifacts')->get();
    }

    public function destroy(Exhibition $exhibition)
    {
        $exhibition->delete();
    }
}
