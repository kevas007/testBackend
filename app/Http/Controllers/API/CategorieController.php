<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():JsonResource
    {
        try {
            $categorie = Categorie::all();
            return response()->json([
                'message' => 'get all  projects',
                'data'   => $categorie,
            ], 200);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) :JsonResource
    {
     try {
         $validated = $request->validate([
             'name' => 'required|string|max:255',
         ]);
         $categorie = Categorie::create($request->all());

         return response()->json([
             'message' => 'create project',
             'data' => $categorie,
         ],201);
     }
     catch (\Exception $e) {
             return response()->json(['error' => $e->getMessage()], 500);
         }
    }

    /**
     * Display the specified resource.
     */
    public function show(Categorie $categorie):JsonResource
    {
        try {
            return response()->json([
                'message' => 'get project',
                'data' => $categorie,
            ],200);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categorie $categorie):JsonResource
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255'
            ]);
            $categorie->update($request->all());
            return response()->json([
                'message' => 'update project',
                'data' => $categorie
            ]);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorie $categorie):JsonResource
    {
        try {
            $categorie->delete();
            return response()->json([
                'message' => 'delete project'
            ],200);
        }
        catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }
}
