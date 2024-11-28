@extends('components.layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Editar Advogado</h1>

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
                <form action="{{ route('advogado.update', $advogado->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="nome">Nome:</label>
                        <input type="text" name="nome" class="form-control" value="{{ old('nome', $advogado->nome) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $advogado->email) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="telefone">Telefone:</label>
                        <input type="number" name="telefone" class="form-control" value="{{ old('telefone', $advogado->telefone) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="endereco">Endereço:</label>
                        <input type="text" name="endereco" class="form-control" value="{{ old('endereco', $advogado->endereco) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="especialidade_id">Especialidade:</label>
                        <select name="especialidade_id" class="form-control" required>
                            <option value="">Selecione uma especialidade</option>
                            @foreach($especialidade as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $advogado->especialidade_id ? 'selected' : '' }}>
                                    {{ $item->descricao }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    <a href="{{ route('advogado.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
