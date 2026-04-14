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
        Schema::create('eleves', function (Blueprint $table) {
        $table->id();
        // Relations
        $table->unsignedBigInteger('id_parent');
        $table->unsignedBigInteger('id_classe');
        $table->unsignedBigInteger('id_enseignant');
        $table->string('nom');
        $table->string('prenom');
        $table->string('matiere')->nullable();
        $table->timestamps();
        // Foreign keys
        $table->foreign('id_parent')
              ->references('id')
              ->on('le__parents')
              ->onDelete('cascade');
        $table->foreign('id_classe')
              ->references('id')
              ->on('classe_virtuelles')
              ->onDelete('cascade');
        $table->foreign('id_enseignant')
              ->references('id')
              ->on('enseignants')
              ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eleves');
    }
};
