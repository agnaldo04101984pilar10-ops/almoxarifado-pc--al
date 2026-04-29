<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_siap')->unique(); // Chave para busca automática
            $table->string('nome'); // Descrição do item
            $table->string('unidade_medida'); // Unidade (Frasco, Un, etc)
            $table->integer('estoque_atual')->default(0);
            $table->timestamps();
        });

        // Tabela para os Limites Mensais por Setor (Item 8 da sua lista)
        Schema::create('material_setor_limites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('material_id')->constrained()->onDelete('cascade');
            $table->string('setor'); // Nome do setor (ex: IC, IML)
            $table->integer('limite_mensal'); // Quantidade máxima permitida
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('material_setor_limites');
        Schema::dropIfExists('materials');
    }
};