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
    public function index()
    {
        try {
            $categorie = Categorie::with('depense')->get();

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
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $categorie = Categorie::create($validated);

            return response()->json([
                'message' => 'Catégorie créée avec succès.',
                'data' => $categorie,
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Une erreur est survenue.',
                'details' => $e->getMessage(),
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Categorie $categorie)
    {
        try {

            return response()->json([
                'message' => 'Catégorie récupérée avec succès.',
                'data' => $categorie,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Une erreur est survenue.',
                'details' => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categorie $categorie)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255'
            ]);

            $categorie->update($validated);

            return response()->json([
                'message' => 'Catégorie mise à jour avec succès.',
                'data' => $categorie
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorie $categorie)
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

    public function getState()
    {
        try {
            $state = Categorie::withSum('depense', 'montant')->get();
            return response()->json([
                "message" => "toutes les statistiques",
                'data' => $state,
            ],200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }
}
