<?php

namespace App\Http\Controllers;

use App\Models\Especialidade;
use Illuminate\Http\Request;

class EspecialidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $especialidades = Especialidade::all();

        return view('especialidade.index')->with('especialidades', $especialidades);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('especialidade.adicionar');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'descricao'  => 'required|string|max:255'
        ]);

        try {
            Especialidade::create([
                'descricao' => $validated['descricao']
            ]);

            return redirect()->route('especialidade.index')->with('success', 'Especialidade adicionada com sucesso!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', "Houve um erro ao criar a especialidade: {$e->getMessage()}");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Especialidade $especialidade)
    {
        return view('especialidade.listagem')->with('especialidade', $especialidade);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Especialidade $especialidade)
    {
        return view('especialidade.editar')->with('especialidade', $especialidade);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Especialidade $especialidade)
    {
        $validated = $request->validate([
            'descricao' => 'required|string|max:255'
        ]);

        try {
            $especialidade->update($request->only('descricao'));

            return redirect()->route('especialidade.index')->with('success', 'Especialidade editada com sucesso!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', "Houve um erro ao editar a especialidade: {$e->getMessage()}");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Especialidade $especialidade)
    {
        try {
            $especialidade->delete();

            return redirect()->route('especialidade.index')->with('success', 'Especialidade removida com sucesso!');
        } catch (Exception $e) {
            return redirect()->route('especialidade.index')->with('error', "Houve um erro ao excluir a especialidade! {$e->getMessage()}");
        }
    }
}
