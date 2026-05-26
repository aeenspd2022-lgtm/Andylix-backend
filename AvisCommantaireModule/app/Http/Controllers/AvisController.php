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
    public function index(int $artisan_id)
    {
        try {
            $avis = Avis::with('commentaires')->where('artisan_id', $artisan_id)->orderByDesc('created_at')->get();
            return response()->json(['data' => $avis,]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AvisStoreRequest $request, int $user, int $artisan)
    {
        try {
            $avis = Avis::create($request->validated());
            return response()->json([
                'message' => 'Avis créé avec succès.',
                'data' => $avis,
            ], 201);
            return response()->json(['message' => 'Action non authorisee.', $user], 201);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th,], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AvisUpdateRequest $request, int $user, Avis $avis)
    {
        try {
            if ($user === $avis->user_id) {
                $avis->update($request->validated());
                return response()->json([
                    'message' => 'Avis mis à jour avec succès.',
                    'data' => $avis->load('commentaires')
                ]);
            }
            return response()->json(['message' => 'Action non authorisee.'], 403);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th,], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $user, Avis $avis)
    {
        try {
            if ($user === $avis->user_id) {
                $avis->delete();
                return response()->json(['message' => 'Avis supprimé avec succès.']);
            }
            return response()->json(['message' => 'Action non authorisee.'], 403);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th,], 500);
        }
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

    function AdminIndex()
    {
        try {
            $avis = Avis::with('commentaires')->orderByDesc('created_at')->paginate(10);
            return response()->json(['data' => $avis], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th], 500);
        }
    }
}
