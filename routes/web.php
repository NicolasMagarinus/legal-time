<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AgendamentoController;

Route::get('/', function () {
    if (!Auth::check())
        return view('login');

    return view('welcome');
})->name('home');

// Rotas de login e logout
Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'entrar'])->name('login.entrar');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rotas para gerenciamento de usuários
Route::resource('usuario', UsuarioController::class);

//Rotas para gerenciamento dos agendamentos
Route::resource('agendamento', AgendamentoController::class);
