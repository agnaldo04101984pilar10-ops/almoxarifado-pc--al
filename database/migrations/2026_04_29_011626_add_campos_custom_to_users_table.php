<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Verifica se a coluna não existe antes de criar (para evitar erros)
            if (!Schema::hasColumn('users', 'tipo_usuario')) {
                $table->string('tipo_usuario')->default('setor')->after('password');
            }
            if (!Schema::hasColumn('users', 'setor')) {
                $table->string('setor')->nullable()->after('tipo_usuario');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['tipo_usuario', 'setor']);
        });
    }
};