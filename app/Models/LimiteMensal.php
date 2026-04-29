<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LimiteMensal extends Model
{
    protected $table = 'limites_mensais';
    protected $fillable = ['setor', 'material_id', 'quantidade_limite'];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}