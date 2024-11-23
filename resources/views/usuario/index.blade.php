@extends('components.layouts.app')

@section('title', 'Listagem de Usuários')

@section('content')
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

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="position-relative">
                <span class="position-absolute search-icon"><i class="fa fa-search"></i></span>
                &nbsp;
                <input id="search-input" type="text" class="form-control" placeholder="Pesquisar por nome ou email...">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr class="bg-light">
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Endereço</th>
                        <th scope="col" class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody id="user-table">
                    @foreach($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->nome }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ $usuario->telefone }}</td>
                            <td>{{ $usuario->endereco }}</td>
                            <td class="text-center">
                                <a href="{{ route('usuario.show', $usuario->id) }}" class="btn btn-info btn-sm" title="Informações">
                                    <i class="fas fa-solid fa-bars"></i>
                                </a>
                                <a href="{{ route('usuario.edit', $usuario->id) }}" class="btn btn-warning btn-sm" title="Editar">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <form action="{{ route('usuario.destroy', $usuario->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir este usuário?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Excluir">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
