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
        Schema::create('reponse_devoirs', function (Blueprint $table) {
        $table->id();
        $table->string('fichier')->nullable();
        $table->foreignId('devoir_id')->constrained('devoirs')->onDelete('cascade');
        $table->foreignId('eleve_id')->constrained('eleves')->onDelete('cascade');
        $table->text('reponse');
        $table->string('envoye_par'); // eleve / parent
        $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reponse_devoirs');
    }
};
