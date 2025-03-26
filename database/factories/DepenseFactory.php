<?php

namespace Database\Factories;

use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Depense>
 */
class DepenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categorie = DB::table('categories')->inRandomOrder()->first();

        return [
            'titre' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'montant' => $this->faker->randomFloat(2, 1, 1000),
            'date' => $this->faker->date(),
            'src' => $this->faker->imageUrl(),
            'categorie_id' => $categorie ? $categorie->id : null,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}



