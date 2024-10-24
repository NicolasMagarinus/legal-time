<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index() {
        return view('login');
    }

    public function entrar(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'senha' => 'required|string|min:8'
        ]);

        $usuario = Usuario::where('email', '=', $request->email)->first();

        if ($usuario && Hash::check($request->senha, $usuario->senha)) {
            Auth::login($usuario);

            return redirect('/')->with('success', 'Você está logado!');
        } else {
            return back()->withErrors(['error' => 'As credenciais não estão nos registros!']);
        }
    }

    public function logout(Request $request) {
        if (!Auth::check())
            abort(404);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout efetuado com sucesso!');
    }
}
