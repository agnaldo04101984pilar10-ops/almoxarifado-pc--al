<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'material_id',
        'setor_id',
        'quantidade',
        'valor_unitario', // Esta linha faltava!
        'valor_total',
    ];

    public function material() {
        return $this->belongsTo(Material::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function setor() {
        return $this->belongsTo(Setor::class);
    }
}