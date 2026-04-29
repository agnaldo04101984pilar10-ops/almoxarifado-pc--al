<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisicao extends Model
{
    use HasFactory;

    // Nome da tabela no banco
    protected $table = 'requisicoes';

    protected $fillable = [
        'user_id', 
        'setor', 
        'status'
    ];

    // Relacionamento: Uma requisição tem muitos itens
    public function itens()
    {
        return $this->hasMany(ItemRequisicao::class, 'requisicao_id');
    }

    // Relacionamento: Uma requisição pertence a um usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}