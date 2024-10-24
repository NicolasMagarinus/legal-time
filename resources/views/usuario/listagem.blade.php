@extends('components.layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Detalhes do Usuário</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $usuario->nome }}</h5>
                <p class="card-text"><strong>Email:</strong> {{ $usuario->email }}</p>
                <p class="card-text"><strong>Telefone:</strong> {{ $usuario->telefone }}</p>
                <p class="card-text"><strong>Endereço:</strong> {{ $usuario->endereco }}</p>
                <a href="{{ route('usuario.index') }}"><i class="fa-solid fa-arrow-left"></i></a>
                <form action="{{ route('usuario.destroy', $usuario->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Tem certeza que deseja excluir este usuário?')"><i class="fa-solid fa-trash"></i></button>
                </form>
            </div>
        </div>
    </div>
@endsection
