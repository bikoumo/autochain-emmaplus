<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('connexions', function (Blueprint $table) {
            $table->string('statut_connexion', 20)->default('succes')->after('statut_blocage');
        });
    }

    public function down(): void
    {
        Schema::table('connexions', function (Blueprint $table) {
            $table->dropColumn('statut_connexion');
        });
    }
};

