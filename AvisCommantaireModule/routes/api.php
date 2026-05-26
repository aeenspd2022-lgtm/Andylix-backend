<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// public routes
Route::get('public/artisan/{artisan_id}/avis', [\App\Http\Controllers\AvisController::class, 'index']);//ok 1
// users routes
Route::post('user/{user}/artisan/{artisan}/avis', [\App\Http\Controllers\AvisController::class, 'store']);//ok 1
Route::post('user/{user}/avis/{avis}/commentaire', [\App\Http\Controllers\CommentaireController::class, 'store']);
Route::put('user/{user}/artisan/{artisan}/avis/{avis}', [\App\Http\Controllers\AvisController::class, 'update']);
Route::put('user/{user}/artisan/{artisan}/avis/{avis}/commentaire/{commentaire}', [\App\Http\Controllers\CommentaireController::class, 'update']);
Route::delete('user/{user}/avis/{avis}', [\App\Http\Controllers\AvisController::class, 'destroy']);
Route::delete('user/{user}/commentaire/{commentaire}', [\App\Http\Controllers\CommentaireController::class, 'destroy']);
// admin routes
Route::get('admin/avis', [\App\Http\Controllers\AvisController::class, 'AdminIndex']);//ok -1
Route::get('admin/commentaires', [\App\Http\Controllers\CommentaireController::class, 'index']);//ok -1
Route::put('admin/avis/{avis}/visibility', [\App\Http\Controllers\AvisController::class, 'toggleVisibility']);//ok -1
Route::put('admin/commentaire/{commentaire}/visibility', [\App\Http\Controllers\CommentaireController::class, 'toggleVisibility']);//ok -1
// artisan routes
Route::post('artisan/{artisan}/avis/{avis}/litige', [\App\Http\Controllers\AvisLitigeController::class, 'store']);
Route::post('artisan/{artisan}/commentaire/{commentaire}/litige', [\App\Http\Controllers\CommentaireLitigeController::class, 'store']); //ok 1
Route::delete('artisan/{artisan}/avis/litige/{avis_Litige}', [\App\Http\Controllers\AvisLitigeController::class, 'destroy']); //ok
Route::delete('artisan/{artisan}/commentaire/litige/{commentaire_Litige}', [\App\Http\Controllers\CommentaireLitigeController::class, 'destroy']);// ok
Route::put('artisan/{artisan}/avis/litige/{avis_Litige}', [\App\Http\Controllers\AvisLitigeController::class, 'update']); //ok 1
Route::put('artisan/{artisan}/commentaire/litige/{commentaire_Litige}', [\App\Http\Controllers\CommentaireLitigeController::class, 'update']);//ok 1

