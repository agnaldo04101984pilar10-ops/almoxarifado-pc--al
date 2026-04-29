<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('requisicoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); // Quem pediu
            $table->string('setor'); // Setor no momento do pedido
            $table->string('status')->default('Pendente'); // Pendente, Aprovada, Entregue
            $table->timestamps();
        });

        Schema::create('item_requisicao', function (Blueprint $table) {
            $table->id();
            $table->foreignId('requisicao_id')->constrained('requisicoes')->onDelete('cascade');
            $table->foreignId('material_id')->constrained();
            $table->integer('quantidade_solicitada');
            $table->integer('quantidade_atendida')->nullable(); // Preenchido pelo almoxarifado depois
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_requisicao');
        Schema::dropIfExists('requisicoes');
    }
};