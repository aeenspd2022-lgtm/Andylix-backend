<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentaireStoreRequest;
use App\Http\Requests\CommentaireUpdateRequest;
use App\Models\Avis;
use App\Models\Commentaire;
use App\Models\User;
use Faker\Provider\Lorem;

class CommentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $commentaires = Commentaire::with('avis')->orderByDesc('created_at')->paginate(10);
            return response()->json([
                'data' => $commentaires,
            ]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th,], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentaireStoreRequest $request,int $user, Avis $avis)
    {

        if ($user === $avis->artisan_id) {
            $commentaire = Commentaire::create($request->validated());
            return response()->json([
                'message' => 'Commentaire créé avec succès.', $user
                'data' => $commentaire->load('avis'),
            ], 201);
        }
        return response()->json([
            'message' => 'Action non authorisée.',
        ], 403);
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
    public function destroy(User $user, Commentaire $commentaire)
    {
        if ($user->user_id === $commentaire->user_id) {
            $commentaire->delete();
            return response()->json([
                'message' => 'Commentaire supprimé avec succès.',
            ]);
        }
        return response()->json([
            'message' => 'Action non authorisée',
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
