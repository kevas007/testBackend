<?php

namespace Database\Seeders;
use Database\Factories\DepesenseFactory;
use App\Models\Categorie;
use App\Models\Depense;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Categorie::factory(5)->create();

        Depense::factory(10)->create();


    }
}
