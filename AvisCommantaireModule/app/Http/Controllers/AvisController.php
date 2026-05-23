<?php

namespace App\Http\Controllers;

use App\Http\Requests\AvisStoreRequest;
use App\Http\Requests\AvisUpdateRequest;
use App\Models\Avis;
use App\Models\User;

class AvisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($artisan_id)
    {
        $avis = Avis::with('commentaires')
            ->where('artisan_id', $artisan_id)
            ->where('isVisible', true)
            ->orderByDesc('created_at')
            ->get();

        return response()->json([
            'data' => $avis,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AvisStoreRequest $request, $artisan_id)
    {
        $avis = Avis::create($request->validated());
        return response()->json([
            'message' => 'Avis créé avec succès.',
            'data' => $avis->load('commentaires'),
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AvisUpdateRequest $request, $artisan_id, Avis $avis)
    {
        $avis->update($request->validated());
        return response()->json([
            'data' => $avis->load('commentaires')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, Avis $avis)
    {
        $avis->delete();
        return response()->json(['message' => 'Avis supprimé avec succès']);
    }

    /**
     * Toggle visibility of an avis.
     */
    public function toggleVisibility(Avis $avis)
    {
        $avis->update([
            'isVisible' => !$avis->isVisible,
        ]);

        return response()->json([
            'message' => 'Visibilité de l\'avis mise à jour.',
            'data' => $avis,
        ]);
    }
}
