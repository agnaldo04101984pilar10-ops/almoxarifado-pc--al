<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('entradas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('material_id')->constrained('materials'); // Qual material chegou?
        $table->integer('quantidade'); // Quanto chegou?
        $table->string('documento')->nullable(); // NF ou Número do Processo
        $table->string('fornecedor')->nullable(); // Quem entregou?
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entradas');
    }
};
