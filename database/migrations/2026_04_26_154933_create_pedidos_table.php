<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Criar a tabela de pedidos com as chaves estrangeiras corretas.
     */
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            
            // Relaciona com a tabela de usuários
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Relaciona com a tabela de materiais (Nome padrão: materials)
            $table->foreignId('material_id')->constrained('materials')->onDelete('cascade');
            
            // Relaciona com a tabela de setores (Especificando 'setores' para evitar o erro 'setors')
            $table->foreignId('setor_id')->constrained('setores')->onDelete('cascade');
            
            $table->integer('quantidade');
            $table->decimal('valor_unitario', 10, 2);
            $table->decimal('valor_total', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverter a migração.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};