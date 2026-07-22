<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom')->nullable();
            $table->string('email')->unique();
            $table->string('telephone', 20)->nullable();
            $table->string('wallet_adresse', 42)->nullable();
            $table->string('role')->default('chauffeur'); // directrice_generale, chauffeur, garagiste, auditeur
            $table->string('statut_blocage')->default('actif'); // actif, bloque
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('utilisateurs');
    }
};

