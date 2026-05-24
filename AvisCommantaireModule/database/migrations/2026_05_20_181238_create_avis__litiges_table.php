<?php

use App\Models\Avis;
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
        Schema::create('avis__litiges', function (Blueprint $table) {
            $table->id();
            $table->integer('artisan_id');
            $table->foreignIdFor(Avis::class)->constrained()->cascadeOnDelete();
            $table->text('contenu');
            $table->boolean('isResolu')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avis__litiges');
    }
};
