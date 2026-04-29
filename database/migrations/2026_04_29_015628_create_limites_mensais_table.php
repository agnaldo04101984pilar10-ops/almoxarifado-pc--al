<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('limites_mensais', function (Blueprint $table) {
            $table->id();
            $table->string('setor'); // Ex: 'IML - Maceió'
            $table->foreignId('material_id')->constrained('materials')->onDelete('cascade');
            $table->integer('quantidade_limite');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('limites_mensais');
    }
};