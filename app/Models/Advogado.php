<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advogado extends Model
{
    use HasFactory;

    protected $table = 'advogado';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'especialidade_id',
        'endereco'
    ];
}
