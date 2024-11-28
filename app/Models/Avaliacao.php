<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Avaliacao extends Model
{
    use HasFactory;

    protected $table = 'avaliacao';

    protected $primaryKey = 'id';

    protected $fillable = [
        'usuario_id',
        'advogado_id',
        'nota',
        'comentario'
    ];

    public static function buscaAvaliacoes()
    {
        $avaliacoes = DB::table("avaliacao AS av")
            ->join("usuario  AS u",  "u.id",  "=", "av.usuario_id")
            ->join("advogado AS ad", "ad.id", "=", "av.advogado_id")
            ->select("av.id", "av.nota", "av.comentario", "ad.nome")
            ->where("av.usuario_id", "=", Auth::user()->id)
            ->get();

        return $avaliacoes;
    }
}
