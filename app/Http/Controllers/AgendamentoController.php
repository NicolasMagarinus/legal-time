<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use Illuminate\Http\Request;
use App\Models\Advogado;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AgendamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agendamentos = Agendamento::buscaAgendamentos();

        return view('agendamento.index')->with('agendamentos', $agendamentos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $advogados = DB::table('advogado')->pluck('nome', 'id');

        return view('agendamento.adicionar')->with('advogados', $advogados);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'advogado_id' => 'required|integer',
            'data'        => 'required',
            'status'      => 'required|integer'
        ]);

        try {
            $data = Carbon::createFromFormat('Y-m-d\TH:i', $validated['data'])->format('Y-m-d H:i:s');

            Agendamento::create([
                'advogado_id' => $validated['advogado_id'],
                'usuario_id'  => Auth::user()->id,
                'data'        => $data,
                'status'      => $validated['status']
            ]);

            return redirect()->route('agendamento.index')->with('success', 'Agendamento realizado com sucesso!');
        } catch (Exception $e) {
            dd($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Agendamento $agendamento)
    {
        $advogado = Advogado::findOrFail($agendamento->advogado_id);
        $data = date('d/m/Y H:i:s', strtotime($agendamento->data));

        return view('agendamento.listagem')
            ->with('agendamento', $agendamento)
            ->with('advogado',    $advogado)
            ->with('data',        $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agendamento $agendamento)
    {
        $advogados = DB::table('advogado')->pluck('nome', 'id');

        return view('agendamento.editar')
            ->with('agendamento', $agendamento)
            ->with('advogados',   $advogados);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agendamento $agendamento)
    {
        $validated = $request->validate([
            'advogado_id' => 'required|integer',
            'data'        => 'required',
            'status'      => 'required|integer'
        ]);

        try {
            $data = Carbon::createFromFormat('Y-m-d\TH:i', $validated['data'])->format('Y-m-d H:i:s');

            Agendamento::where('id', $agendamento->id)
                ->update(['advogado_id' => $validated['advogado_id'],
                          'usuario_id'  => Auth::user()->id,
                          'data'        => $data,
                          'status'      => $validated['status']]);

            $advogado = Advogado::findOrFail($agendamento->advogado_id);

            return redirect()->route('agendamento.show', [$agendamento, $advogado])->with('success', 'Agendamento atualizado com sucesso!');
        } catch (Exception $e) {
            dd($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agendamento $agendamento)
    {
        try {
            $agendamento->delete();

            return redirect()->route('agendamento.index')->with('success', 'Agendamento removido com sucesso!');
        } catch (Exception $e) {
            return redirect()->route('agendamento.index')->with('error', "Houve um erro ao excluir o agendamento! $e");
        }
    }
}
