<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    use HasFactory;

    // Adicione este bloco abaixo:
    protected $fillable = [
        'material_id',
        'quantidade',
        'documento',
        'fornecedor'
    ];

    // Relacionamento para podermos ver o nome do material depois
    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}