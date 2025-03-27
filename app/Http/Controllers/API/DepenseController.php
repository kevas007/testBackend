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
            $depenses = Depense::with('categorie')->get();
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
                'titre' => 'required|string|max:255',
                'montant' => 'required|numeric',
                'date' => 'required|date',
                'categorie_id' => 'required|exists:categories,id',
                'src' => 'nullable|file|mimes:pdf|max:2048',
                'description' => 'nullable|string',
            ]);

            // Traitement du fichier justificatif (PDF)
            if ($request->hasFile('src')) {
                $path = $request->file('src')->store('justificatifs', 'public');
                $validatedData['src'] = $path;
            }

            $depense = Depense::create($validatedData);

            return response()->json([
                'message' => 'Dépense créée avec succès.',
                'data' => $depense,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Une erreur est survenue.',
                'details' => $e->getMessage(),
            ], 500);
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
                'titre' => 'required|string|max:255',
                'montant' => 'required|numeric',
                'date' => 'required|date',
                'categorie_id' => 'required|exists:categories,id',
                'src' => 'nullable|file|mimes:pdf|max:2048',
                'description' => 'nullable|string',
            ]);

            // Si un nouveau fichier PDF est envoyé, remplace l'ancien
            if ($request->hasFile('src')) {
                // Supprimer l'ancien fichier si présent
                if ($depense->src && \Storage::disk('public')->exists($depense->src)) {
                    \Storage::disk('public')->delete($depense->src);
                }

                // Enregistrer le nouveau fichier
                $path = $request->file('src')->store('justificatifs', 'public');
                $validatedData['src'] = $path;
            }

            $depense->update($validatedData);

            return response()->json([
                'message' => 'Dépense mise à jour avec succès.',
                'data' => $depense,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Une erreur est survenue.',
                'details' => $e->getMessage(),
            ], 500);
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
