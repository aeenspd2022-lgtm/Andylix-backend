<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentaireStoreRequest;
use App\Http\Requests\CommentaireUpdateRequest;
use App\Models\Commentaire;

class CommentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commentaires = Commentaire::with('avis')
            ->where('isVisible', true)
            ->orderByDesc('created_at')
            ->get();

        return response()->json([
            'data' => $commentaires,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentaireStoreRequest $request)
    {
        $commentaire = Commentaire::create($request->validated());

        return response()->json([
            'message' => 'Commentaire créé avec succès.',
            'data' => $commentaire->load('avis'),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Commentaire $commentaire)
    {
        return response()->json([
            'data' => $commentaire->load('avis'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommentaireUpdateRequest $request, Commentaire $commentaire)
    {
        $commentaire->update($request->validated());

        return response()->json([
            'message' => 'Commentaire mis à jour avec succès.',
            'data' => $commentaire->load('avis'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commentaire $commentaire)
    {
        $commentaire->delete();

        return response()->json([
            'message' => 'Commentaire supprimé avec succès.',
        ]);
    }

    /**
     * Toggle visibility of a commentaire.
     */
    public function toggleVisibility(Commentaire $commentaire)
    {
        $commentaire->update([
            'isVisible' => !$commentaire->isVisible,
        ]);

        return response()->json([
            'message' => 'Visibilité du commentaire mise à jour.',
            'data' => $commentaire,
        ]);
    }
}
