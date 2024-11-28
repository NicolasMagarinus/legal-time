<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Advogado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::all();

        return view('usuario.index')->with('usuarios', $usuarios);
    }

    public function show($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuario.listagem')->with('usuario', $usuario);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome'     => 'required|string|max:50',
            'email'    => 'required|email|unique:usuario,email',
            'senha'    => 'required|string|min:8|max:16|confirmed',
            'telefone' => 'required|string|max:20',
            'endereco' => 'required|string|max:255',
            'id_tipo'  => 'required|in:0,1'
        ]);

        try {
            Usuario::create([
                'nome'     => $validated['nome'],
                'email'    => $validated['email'],
                'telefone' => $validated['telefone'],
                'endereco' => $validated['endereco'],
                'senha'    => Hash::make($validated['senha']),
                'id_tipo'  => $request->id_tipo
            ]);

            if ($request->id_tipo == 1) {
                Advogado::create([
                    'nome'     => $request->nome,
                    'email'    => $request->email,
                    'telefone' => $request->telefone,
                    'endereco' => $request->endereco
                ]);
            }

            return redirect()->route('login.index')->with('success', 'Usuário criado com sucesso!');
        } catch (Exception $e) {
            return redirect()->route('login.index')->with('error', "Houve um erro ao criar o usuário: {$e->getMessage()}");
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        return view('usuario.editar')->with('usuario', $usuario);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'telefone' => 'required|string',
            'endereco' => 'required|string',
        ]);

        $usuario->update($request->only('nome', 'email', 'telefone', 'endereco'));

        return redirect()->route('usuario.show', $usuario)->with('success', 'Informações atualizadas com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        try {
            $usuario->delete();

            return redirect()->route('usuario.index')->with('success', 'Usuário removido com sucesso!');
        } catch (Exception $e) {
            return redirect()->route('usuario.index')->with('error', 'Houve um erro ao excluir o usuário!');
        }
    }
}
