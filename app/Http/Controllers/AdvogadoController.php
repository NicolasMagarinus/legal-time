<?php

namespace App\Http\Controllers;

use App\Models\Advogado;
use App\Models\Usuario;
use App\Models\Especialidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Exception;

class AdvogadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $advogado = DB::table('advogado AS ad')
            ->join('usuario AS u', 'u.email', '=', 'ad.email')
            ->leftjoin('especialidade AS e', 'e.id', '=', 'ad.especialidade_id')
            ->select('ad.id', 'ad.nome', 'e.descricao')
            ->where('u.id', '=', Auth::user()->id)
            ->first();

        return view('advogado.index')->with('advogado', $advogado);
    }

    /**
     * Display the specified resource.
     */
    public function show(Advogado $advogado)
    {
        $especialidade = Especialidade::findOrFail($advogado->especialidade_id);
        return view('advogado.listagem')
            ->with('advogado',      $advogado)
            ->with('especialidade', $especialidade);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Advogado $advogado)
    {
        $especialidade = Especialidade::all();

        return view('advogado.editar')
            ->with('advogado',      $advogado)
            ->with('especialidade', $especialidade);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Advogado $advogado)
    {
        $validated = $request->validate([
            'nome'     => 'required|string|max:50',
            'email'    => 'required|email|unique:usuario,email,' . Auth::user()->id,
            'telefone' => 'required|string|max:20',
            'endereco' => 'required|string|max:255'
        ]);

        try {
            $user = Usuario::findOrFail(Auth::user()->id);
            $user->update([
                'nome'     => $validated['nome'],
                'email'    => $validated['email'],
                'telefone' => $validated['telefone'],
                'endereco' => $validated['endereco']
            ]);

            if ($user->id_tipo == 1) {
                $advogado->update([
                    'nome'             => $validated['nome'],
                    'email'            => $validated['email'],
                    'telefone'         => $validated['telefone'],
                    'endereco'         => $validated['endereco'],
                    'especialidade_id' => $request->especialidade_id
                ]);
            }

            return redirect()->route('advogado.listagem', [$advogado])->with('success', 'Informações atualizadas com sucesso!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', "Houve um erro ao atualizar as informações: {$e->getMessage()}");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Advogado $advogado)
    {
        try {
            $advogado->delete();

            return view('login')->with('success', 'Usuário/advogado excluídos com sucesso!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', "Houve um erro excluir o usuário: {$e->getMessage()}");
        }
    }
}
