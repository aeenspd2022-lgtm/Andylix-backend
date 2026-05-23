<?php

use App\Models\Commentaire;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('commentaire__litiges', function (Blueprint $table) {
            $table->id();
            $table->integer('artisan_id');
            $table->foreignIdFor(Commentaire::class)->constrained()->cascadeOnDelete();
            $table->text('contenu');
            $table->boolean('isResolu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commentaire__litiges');
    }
};
