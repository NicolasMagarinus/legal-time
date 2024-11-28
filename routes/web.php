<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\AdvogadoController;
use App\Http\Controllers\EspecialidadeController;

Route::get('/', function () {
    if (!Auth::check())
        return view('login');

    return view('welcome');
})->name('home');

Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'entrar'])->name('login.entrar');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::resource('usuario', UsuarioController::class);

Route::resource('agendamento', AgendamentoController::class);

Route::resource('avaliacao', AvaliacaoController::class);

Route::resource('advogado', AdvogadoController::class);

Route::resource('especialidade', EspecialidadeController::class);
