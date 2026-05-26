<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentaireLitigeStoreRequest;
use App\Http\Requests\CommentaireLitigeUpdateRequest;
use App\Models\Commentaire;
use App\Models\Commentaire_Litige;

class CommentaireLitigeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentaireLitigeStoreRequest $request, int $artisan, Commentaire $commentaire)
    {
        try {
            if ($artisan === $commentaire->avis->artisan_id) {
                $litige = Commentaire_Litige::create($request->validated());
                return response()->json([
                    'message' => 'Litige commentaire créé avec succès.',
                    'data' => $litige->load('commentaire'),
                ], 201);
            }
            return response()->json(['message' => 'Action non authorisée.'], 201);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Une erreur est survenue.' . $th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Commentaire_Litige $commentaire_Litige)
    {
        return response()->json([
            'data' => $commentaire_Litige->load('commentaire'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommentaireLitigeUpdateRequest $request, int $artisan, Commentaire_Litige $commentaire_Litige)
    {
        if ($artisan === $commentaire_Litige->commentaire->avis->artisan_id) {
            $commentaire_Litige->update($request->validated());

            return response()->json([
                'message' => 'Litige commentaire mis à jour avec succès.',
                'data' => $commentaire_Litige->load('commentaire'),
            ]);
        }
        return response()->json(['message' => 'Action non authorisée.'], 403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $artisan, Commentaire_Litige $commentaire_Litige)
    {
        try {
            if ($artisan === $commentaire_Litige->commentaire->avis->artisan_id) {
                $commentaire_Litige->delete();
                return response()->json(['message' => 'Litige commentaire supprimé avec succès.']);
            }
            return response()->json(['message' => 'Action non authorisée.'], 201);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Une erreur est survenue.' . $th->getMessage()], 500);
        }
    }
}
