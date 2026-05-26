<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['artisan_id', 'contenu', 'commentaire_id','isResolu'])]
class Commentaire_Litige extends Model
{
    /** @use HasFactory<\Database\Factories\CommentaireLitigeFactory> */
    use HasFactory;

    function commentaire(): BelongsTo
    {
        return $this->belongsTo(Commentaire::class);
    }
}
