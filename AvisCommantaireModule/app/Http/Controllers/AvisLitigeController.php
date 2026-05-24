<?php

namespace App\Http\Controllers;

use App\Http\Requests\AvisLitigeStoreRequest;
use App\Http\Requests\AvisLitigeUpdateRequest;
use App\Models\Avis;
use App\Models\Avis_Litige;

class AvisLitigeController extends Controller
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
    public function store(AvisLitigeStoreRequest $request,$artisan_id, Avis $avis)
    {
        if ($artisan_id === $avis->artisan_id) {
            $litige = Avis_Litige::create($request->validated());

            return response()->json([
                'message' => 'Litige avis créé avec succès.',
                'data' => $litige->load('avis'),
            ], 201);
        }
          return response()->json([ 'message' => 'Action non authorisée.'  ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Avis_Litige $avis_Litige)
    {
        return response()->json([
            'data' => $avis_Litige->load('avis'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AvisLitigeUpdateRequest $request, Avis_Litige $avis_Litige)
    {
        $avis_Litige->update($request->validated());

        return response()->json([
            'message' => 'Litige avis mis à jour avec succès.',
            'data' => $avis_Litige->load('avis'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($artisan, Avis_Litige $avis_Litige)
    {
        if ($artisan === $avis_Litige->artisan_id) {

            $avis_Litige->delete();

            return response()->json([
                'message' => 'Litige avis supprimé avec succès.',
            ]);
        }
        return response()->json([
            'message' => 'Action non authorisée.',
        ]);
    }
}
