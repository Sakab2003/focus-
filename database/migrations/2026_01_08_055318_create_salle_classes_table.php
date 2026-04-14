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
        Schema::create('salle_classes', function (Blueprint $table) {
            $table->id();
            $table->string('nom'); // nom de la salle
            $table->string('code')->unique(); // Code auto-généré
            $table->timestamps();
            $table->unsignedTinyInteger('max_enseignants')->default(5);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salle_classes');
    }
};
