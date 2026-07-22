<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('email'); // email saisi par l'utilisateur
            $table->string('telephone')->nullable();
            $table->string('wallet_saisi')->nullable(); // wallet qu'il a tenté d'utiliser
            $table->string('role_souhaite')->nullable(); // rôle qu'il a choisi dans le select
            $table->enum('statut', ['en_attente', 'validee', 'refusee'])->default('en_attente');
            $table->text('message')->nullable(); // message optionnel
            $table->string('ip_adresse')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('demandes');
    }
};

