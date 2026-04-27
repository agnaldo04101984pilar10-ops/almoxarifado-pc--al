<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setor extends Model
{
    use HasFactory;

    // ESTA LINHA RESOLVE O ERRO:
    protected $table = 'setores';

    protected $fillable = [
        'nome',
        'limite_mensal',
    ];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}