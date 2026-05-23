<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['user_id', 'artisan_id', 'contenu', 'isLitige', 'isVisible'])]
class Avis extends Model
{
    /** @use HasFactory<\Database\Factories\AvisFactory> */
    use HasFactory;

    function commentaires() : HasMany {
        return $this->hasMany(Commentaire::class);
    }
    function Avis_Litige() : BelongsTo {
        return $this->belongsTo(Avis_Litige::class);
    }
}
