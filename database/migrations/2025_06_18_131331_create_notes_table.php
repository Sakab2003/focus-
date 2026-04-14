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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_eleve');
            $table->unsignedBigInteger('id_devoir');
            $table->text('remarque')->nullable();
            $table->longText('devoir_traiter')->nullable(); // contenu CKEditor (HTML)
            $table->float('valeur')->nullable();
            $table->string('fichier')->nullable();
            $table->timestamps();
            $table->foreign('id_eleve')->references('id')->on('eleves')->onDelete('cascade');
            $table->foreign('id_devoir')->references('id')->on('devoirs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
