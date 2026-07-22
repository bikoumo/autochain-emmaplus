<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->string('acheteur_nom');
            $table->string('acheteur_email');
            $table->string('acheteur_telephone', 20)->nullable();
            $table->foreignId('vehicule_id')->nullable()->constrained('vehicles')->nullOnDelete();
            $table->string('type_vehicule')->default('occasion'); // neuf, occasion
            $table->string('mode_paiement')->default('cash'); // cash, tranches
            $table->decimal('montant_total', 12, 2);
            $table->decimal('premiere_tranche', 12, 2)->nullable();
            $table->text('echeancier')->nullable();
            $table->string('statut')->default('en_attente'); // en_attente, payee, annulee
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};

