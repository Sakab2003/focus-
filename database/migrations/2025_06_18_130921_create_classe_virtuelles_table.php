<?php

use App\Models\ClasseVirtuelle;
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
        Schema::create('classe_virtuelles', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nom de la classe
            // Statut logique (non virtuelle / virtuelle)
            $table->unsignedBigInteger('id_utilisateur');
            $table->timestamps();
            $table->foreign('id_utilisateur')->references('id')->on('utilisateurs')->onDelete('cascade');
            $table->foreignId('salle_id')
      ->nullable()
      ->constrained('salle_classes')
      ->nullOnDelete();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classe_virtuelles');
    }
    public function create()
{
    $classes = ClasseVirtuelle::with('enseignant')->get(); // très important
    return view('eleves.create', compact('classes')); // la variable est transmise ici
}
};
