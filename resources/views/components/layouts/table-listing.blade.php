@extends('components.layouts.app')

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

<div class="container mt-5 px-2">
    <div class="mb-2 d-flex justify-content-between align-items-center">
        <form class="d-flex w-100" method="GET" action="{{ route('usuario.index') }}">
            <div class="position-relative w-100">
                <span class="position-absolute search-icon"><i class="fa fa-search"></i></span>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control w-100" placeholder="Pesquisar por nome ou email...">
            </div>
            <button type="submit" class="btn btn-primary ms-3">Buscar</button>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-responsive table-borderless">
            <thead>
                <tr class="bg-light">
                    <th scope="col" width="20%">Nome</th>
                    <th scope="col" width="30%">Email</th>
                    <th scope="col" width="15%">Telefone</th>
                    <th scope="col" width="25%">Endereço</th>
                    <th scope="col" width="10%">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $user)
                <tr>
                    <td>{{ $user->nome }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->telefone }}</td>
                    <td>{{ $user->endereco }}</td>
                    <td>
                        <a href="{{ route('usuario.show', $user->id) }}"><i class="fas fa-solid fa-bars" title="Informações"></i></a>
                        &nbsp;
                        <a href="{{ route('usuario.edit', $user->id) }}"><i class="fas fa-pen" title="Editar"></i></a>
                        &nbsp;
                        <form action="{{ route('usuario.destroy', $user) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Tem certeza que deseja excluir este usuário?')">
                                <i class="fa-solid fa-trash" title="Excluir"></i>
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
