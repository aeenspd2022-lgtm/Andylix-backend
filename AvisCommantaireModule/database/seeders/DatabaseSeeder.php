<?php

namespace Database\Seeders;

use App\Models\Avis;
use App\Models\Avis_Litige;
use App\Models\Commentaire;
use App\Models\Commentaire_Litige;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*   User::factory()->create([
              'name' => 'Test User',
              'email' => 'test@example.com',
          ]); */
        User::factory(10)->create();


        Avis::factory()->count(5)->has(Commentaire::factory()->count(10))->has(Avis_Litige::factory()->count(5))->create();
        Avis::factory()->count(5)->has(Commentaire::factory()->count(10)->has(Commentaire_Litige::factory()->count(5)))->has(Avis_Litige::factory()->count(5))->create();
    }
}
