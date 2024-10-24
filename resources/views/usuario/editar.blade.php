@extends('components.layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Editar Usuário</h1>

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
                <form action="{{ route('usuario.update', $usuario->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="nome">Nome:</label>
                        <input type="text" name="nome" class="form-control" value="{{ old('nome', $usuario->nome) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $usuario->email) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="telefone">Telefone:</label>
                        <input type="text" name="telefone" class="form-control" value="{{ old('telefone', $usuario->telefone) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="endereco">Endereço:</label>
                        <input type="text" name="endereco" class="form-control" value="{{ old('endereco', $usuario->endereco) }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    <a href="{{ route('usuario.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
