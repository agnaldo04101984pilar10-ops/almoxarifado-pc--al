<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'setor_id', // Esta linha permite o vínculo com o setor
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function setor()
    {
        return $this->belongsTo(Setor::class);
    }
}