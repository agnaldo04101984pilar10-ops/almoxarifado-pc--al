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
    Schema::table('pedidos', function (Blueprint $table) {
        // Verifica se a coluna não existe antes de criar (para evitar erros)
        if (!Schema::hasColumn('pedidos', 'user_id')) {
            $table->foreignId('user_id')->after('id')->constrained('users');
        }
        if (!Schema::hasColumn('pedidos', 'material_id')) {
            $table->foreignId('material_id')->after('user_id')->constrained('materials');
        }
        if (!Schema::hasColumn('pedidos', 'quantidade')) {
            $table->integer('quantidade')->after('material_id');
        }
        if (!Schema::hasColumn('pedidos', 'status')) {
            $table->string('status')->default('pendente')->after('quantidade');
        }
    });
}

public function down()
{
    Schema::table('pedidos', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
        $table->dropForeign(['material_id']);
        $table->dropColumn(['user_id', 'material_id', 'quantidade', 'status']);
    });
}
};
