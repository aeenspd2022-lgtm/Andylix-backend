<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['artisan_id', 'avis_id', 'contenu', 'isResolu'])]
class Avis_Litige extends Model
{
    /** @use HasFactory<\Database\Factories\AvisLitigeFactory> */
    use HasFactory;

    function avis() : HasOne {
        return $this->hasOne(Avis::class);
    }


}
