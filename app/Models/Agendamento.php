<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Agendamento extends Model
{
    use HasFactory;

    protected $table = 'agendamento';

    protected $primaryKey = 'id';

    protected $fillable = [
        'usuario_id',
        'advogado_id',
        'data',
        'status'
    ];

    public static function buscaAgendamentos()
    {
        $agendamentos = DB::table("agendamento AS ag")
            ->join("usuario AS u", "u.id", "=", "ag.usuario_id")
            ->join("advogado AS ad", "ad.id", "=", "ag.advogado_id")
            ->select("ag.id", "ag.status", "ad.nome")
            ->selectRaw("TO_CHAR(ag.data, 'DD/MM/YYYY HH24:MI:SS') AS data")
            ->where("ag.usuario_id", "=", Auth::user()->id)
            ->get();

        return $agendamentos;
    }
}
