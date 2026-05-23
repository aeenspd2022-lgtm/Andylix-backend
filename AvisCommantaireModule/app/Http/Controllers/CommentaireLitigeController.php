<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentaireLitigeStoreRequest;
use App\Http\Requests\CommentaireLitigeUpdateRequest;
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
    public function store(CommentaireLitigeStoreRequest $request)
    {
        $litige = Commentaire_Litige::create($request->validated());

        return response()->json([
            'message' => 'Litige commentaire créé avec succès.',
            'data' => $litige->load('commentaire'),
        ], 201);
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
    public function update(CommentaireLitigeUpdateRequest $request, Commentaire_Litige $commentaire_Litige)
    {
        $commentaire_Litige->update($request->validated());

        return response()->json([
            'message' => 'Litige commentaire mis à jour avec succès.',
            'data' => $commentaire_Litige->load('commentaire'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commentaire_Litige $commentaire_Litige)
    {
        $commentaire_Litige->delete();

        return response()->json([
            'message' => 'Litige commentaire supprimé avec succès.',
        ]);
    }
}
