<?php

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
 Schema::create('depenses', function (Blueprint $table) {
         $table->id();
         $table->text('titre');
         $table->text('description')->nullable();
         $table->float('montant');
         $table-> string('src')->nullable();
         $table->date('date');
         $table->foreignId('categorie_id')->constrained();
         $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depenses');
    }
};
