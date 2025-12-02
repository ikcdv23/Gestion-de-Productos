<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre visible del perfil (ej: "Perfil Admin")

            // EL VÍNCULO: Guardamos el email
            $table->string('email')->unique();

            // LA REGLA (Opcional pero recomendada): Este email debe existir en la tabla 'users'
            $table->foreign('email')->references('email')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
