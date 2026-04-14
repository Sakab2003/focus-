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
        Schema::create('eleve_enseignants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_enseignant');
            $table->unsignedBigInteger('id_eleve');
            $table->timestamps();
            $table->foreign('id_enseignant')->references('id')->on('enseignants')->onDelete('cascade');
            $table->foreign('id_eleve')->references('id')->on('eleves')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eleve_enseignants');
    }
};
