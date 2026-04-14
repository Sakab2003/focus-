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
        Schema::create('matieres', function (Blueprint $table) {
           $table->id();
    $table->unsignedBigInteger('id_utilisateur'); // Données métier
    $table->string('name');                 // Nom de la matière
    $table->string('school_year');           // Année scolaire (2025-2026)
    $table->string('code')->unique();        // Code auto
    $table->unsignedTinyInteger('max_teachers')->default(10);
    $table->timestamps();
    $table->foreign('id_utilisateur')
          ->references('id')
          ->on('utilisateurs')
          ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matieres');
    }
};
