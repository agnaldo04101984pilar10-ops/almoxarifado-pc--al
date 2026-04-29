<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemRequisicao extends Model
{
    use HasFactory;

    // Nome da tabela no banco
    protected $table = 'item_requisicao';

    protected $fillable = [
        'requisicao_id', 
        'material_id', 
        'quantidade_solicitada', 
        'quantidade_atendida'
    ];

    // Relacionamento: O item pertence a uma requisição
    public function requisicao()
    {
        return $this->belongsTo(Requisicao::class);
    }

    // Relacionamento: O item refere-se a um material
    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}