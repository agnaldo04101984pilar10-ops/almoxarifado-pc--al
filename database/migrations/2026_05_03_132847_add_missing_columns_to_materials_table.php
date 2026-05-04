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
    Schema::table('materials', function (Blueprint $table) {
        if (!Schema::hasColumn('materials', 'unidade')) {
            $table->string('unidade')->after('nome')->nullable();
        }
        if (!Schema::hasColumn('materials', 'preco_unitario')) {
            $table->decimal('preco_unitario', 10, 2)->after('estoque_atual')->nullable();
        }
    });
}

public function down()
{
    Schema::table('materials', function (Blueprint $table) {
        $table->dropColumn(['unidade', 'preco_unitario']);
    });
}
};
