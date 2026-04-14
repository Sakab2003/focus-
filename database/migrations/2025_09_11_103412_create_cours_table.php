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
        Schema::create('cours', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_enseignant');
            $table->unsignedBigInteger('id_matiere');
            $table->unsignedBigInteger('id_annee_scolaire');
            $table->string('titre');
            $table->longText('contenu')->nullable(); // contenu CKEditor (HTML)
            $table->string('fichier')->nullable();   // chemin du PDF principal
            $table->timestamps();
            // Nouvelle relation avec la table des classes
            $table->foreign('id_enseignant')->references('id')->on('enseignants')->onDelete('cascade');
            $table->foreign('id_matiere')->references('id')->on('matieres')->onDelete('cascade');
            $table->foreign('id_annee_scolaire')->references('id')->on('annee_scolaires')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cours');
    }
};
