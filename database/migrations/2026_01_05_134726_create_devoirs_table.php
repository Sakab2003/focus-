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
        Schema::create('devoirs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cours');
            $table->string('titre');
            $table->text('contenu')->nullable();
             $table->string('fichier')->nullable();
            $table->date('date_limite')->nullable();
            $table->timestamps();
            $table->foreign('id_cours')->references('id')->on('cours')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devoirs');
    }
};
