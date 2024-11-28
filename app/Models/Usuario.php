<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuario';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nome',
        'email',
        'senha',
        'endereco',
        'telefone',
        'id_tipo'
    ];

    public function setPasswordAttribute($value) {
        $this->attributes['senha'] = bcrypt($value);
    }

    public function getAuthPassword() {
        return $this->senha;
    }
}
