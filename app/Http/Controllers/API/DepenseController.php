<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Depense;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class DepenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $depenses = Depense::all();
            return response()->json([
                'message' => 'success',
                'data' => $depenses,
            ],200);
        }
        catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ],500);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'titre' => 'required',
                'montant' => 'required|float',
                'date' => 'required',
                'categorie_id' => 'required'

            ]);
            $depense = new Depense();
            $depense['titre'] = $validatedData['titre'];
            $depense['montant'] = $validatedData['montant'];
            $depense['date'] = $validatedData['date'];
            $depense['categorie_id'] = $validatedData['categorie_id'];
            $depense['src'] = $validatedData['src'] ?? null;
            $depense['description'] = $validatedData['description'] ?? null;
            $depense->save();
            return response()->json([
                'message' => 'create project',
                'data' => $depense,
            ],201);
        }
        catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Depense $depense)
    {
        try {
            return response()->json([
                'message' => 'success',
                'data' => $depense,
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Depense $depense)
    {
        try {
            $validatedData = $request->validate([
                'titre' => 'required',
                'montant' => 'required|float',
                'date' => 'required',
                'categorie_id' => 'required'
            ]);
            $depense['titre'] = $validatedData['titre'];
            $depense['montant'] = $validatedData['montant'];
            $depense['date'] = $validatedData['date'];
            $depense['categorie_id'] = $validatedData['categorie_id'];
            $depense['src'] = $validatedData['src'] ?? null;
            $depense['description'] = $validatedData['description'] ?? null;
            $depense->save();
            return response()->json([
                'message' => 'update project',
                'data' => $depense,
            ]);
        }catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),

            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Depense $depense)
    {
        try {
            $depense->delete();
            return response()->json([
                'message' => 'delete project',
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }
}
