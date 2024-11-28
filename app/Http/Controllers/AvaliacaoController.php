<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use App\Models\Advogado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AvaliacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $avaliacoes = Avaliacao::buscaAvaliacoes();

        return view('avaliacao.index')->with('avaliacoes', $avaliacoes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $advogados = DB::table('advogado')->pluck('nome', 'id');

        return view('avaliacao.adicionar')->with('advogados', $advogados);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'advogado_id' => 'required|integer',
            'nota'        => 'required|integer',
            'comentario'  => 'required|string|max:255'
        ]);

        try {
            Avaliacao::create([
                'advogado_id' => $validated['advogado_id'],
                'usuario_id'  => Auth::user()->id,
                'nota'        => $validated['nota'],
                'comentario'  => $validated['comentario']
            ]);

            return redirect()->route('avaliacao.index')->with('success', 'Avaliação realizada com sucesso!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', "Houve um erro ao realizar a avaliação: {$e->getMessage()}");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Avaliacao $avaliacao)
    {
        $advogado = Advogado::findOrFail($avaliacao->advogado_id);

        return view('avaliacao.listagem')
            ->with('avaliacao', $avaliacao)
            ->with('advogado',  $advogado);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Avaliacao $avaliacao)
    {
        $advogados = DB::table('advogado')->pluck('nome', 'id');

        return view('avaliacao.editar')
            ->with('advogados', $advogados)
            ->with('avaliacao', $avaliacao);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Avaliacao $avaliacao)
    {
        $validated = $request->validate([
            'advogado_id' => 'required|integer',
            'nota'        => 'required|integer',
            'comentario'  => 'required|string|max:255'
        ]);

        try {
            Avaliacao::where('id', $avaliacao->id)
                ->update(['advogado_id' => $validated['advogado_id'],
                          'comentario'  => $validated['comentario'],
                          'nota'        => $validated['nota']]);

            $advogado = Advogado::findOrFail($avaliacao->advogado_id);

            return redirect()->route('avaliacao.show', [$avaliacao, $advogado])->with('success', 'Avaliação atualizada com sucesso!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', "Houve um erro editar a avaliação: {$e->getMessage()}");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Avaliacao $avaliacao)
    {
        try {
            $avaliacao->delete();

            return redirect()->route('avaliacao.index')->with('success', 'Avaliação removida com sucesso!');
        } catch (Exception $e) {
            return redirect()->route('avaliacao.index')->with('error', "Houve um erro ao excluir a avaliação! $e");
        }
    }
}
