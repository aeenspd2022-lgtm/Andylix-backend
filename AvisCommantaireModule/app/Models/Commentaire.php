<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['user_id','avis_id', 'isLitige', 'isVisible', 'contenu'])]
class Commentaire extends Model
{
    /** @use HasFactory<\Database\Factories\CommentaireFactory> */
    use HasFactory;

    function avis() : BelongsTo {
        return $this->belongsTo(Avis::class);
    }
    function Commentaire_Litige() :  HasOne{
        return $this->hasOne(Commentaire_Litige::class);
    }
}
