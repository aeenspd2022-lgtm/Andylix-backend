<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
// public routes
Route::get('public/artisan/{artisan}/avis', [\App\Http\Controllers\AvisController::class, 'index']);
// users routes
Route::post('user/{user}/artisan/{artisan}/avis', [\App\Http\Controllers\AvisController::class, 'store']);
Route::post('user/{user}/artisan/{artisan}/avis/{avis}/commentaire', [\App\Http\Controllers\CommentaireController::class, 'store']);
Route::put('user/{user}/artisan/{artisan}/avis/{avis}', [\App\Http\Controllers\AvisController::class, 'update']);
Route::put('user/{user}/artisan/{artisan}/avis/{avis}/commentaire/{commentaire}', [\App\Http\Controllers\CommentaireController::class, 'update']);
Route::delete('user/{user}/artisan/{artisan}/avis/{avis}', [\App\Http\Controllers\AvisController::class, 'destroy']);
Route::delete('user/{user}/artisan/{artisan}/avis/{avis}/commentaire/{commentaire}', [\App\Http\Controllers\CommentaireController::class, 'destroy']);
// admin routes
Route::get('admin/avis', [\App\Http\Controllers\AvisController::class, 'index']);
Route::get('admin/commentaires', [\App\Http\Controllers\CommentaireController::class, 'index']);
Route::put('admin/avis/{avis}/visibility', [\App\Http\Controllers\AvisController::class, 'toggleVisibility']);
Route::put('admin/commentaire/{commentaire}/visibility', [\App\Http\Controllers\CommentaireController::class, 'toggleVisibility']);
// artisan routes
Route::post('artisan/{artisan}/avis/{avis}/litige', [\App\Http\Controllers\AvisLitigeController::class, 'store']);
Route::post('artisan/{artisan}/commentaire/{commentaire}/litige', [\App\Http\Controllers\CommentaireLitigeController::class, 'store']);
Route::delete('artisan/{artisan}/avis/{avis}/litige/{litige}', [\App\Http\Controllers\AvisLitigeController::class, 'destroy']);
Route::delete('artisan/{artisan}/commentaire/{commentaire}/litige/{litige}', [\App\Http\Controllers\CommentaireLitigeController::class, 'destroy']);


