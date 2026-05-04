<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    /**
     * Os atributos que podem ser preenchidos em massa.
     * Incluímos o 'status' para permitir a baixa no estoque.
     */
    protected $fillable = [
        'user_id',
        'material_id',
        'setor_id',
        'quantidade',
        'valor_unitario',
        'valor_total',
        'status', // Essencial para o controle de "Pendente" ou "Entregue"
    ];

    /**
     * Relacionamento: O pedido pertence a um Material.
     */
    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    /**
     * Relacionamento: O pedido pertence a um Usuário (o solicitante).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relacionamento: O pedido pertence a um Setor específico.
     */
    public function setor()
    {
        return $this->belongsTo(Setor::class);
    }

    /**
     * Opcional: Um acessório para calcular o valor total automaticamente
     * antes de salvar, caso você não esteja fazendo isso no Controller.
     */
    protected static function booted()
    {
        static::creating(function ($pedido) {
            if ($pedido->valor_unitario && $pedido->quantidade) {
                $pedido->valor_total = $pedido->valor_unitario * $pedido->quantidade;
            }
            
            // Define status inicial como pendente se estiver vazio
            if (!$pedido->status) {
                $pedido->status = 'pendente';
            }
        });
    }
}