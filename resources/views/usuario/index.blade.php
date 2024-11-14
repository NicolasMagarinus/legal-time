@extends('components.layouts.app')

@section('content')
    <div class="bg-image h-100" style="background-color: #f5f7fa;">
        <div class="mask d-flex align-items-center h-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 700px">
                                    <table class="table table-striped mb-0">
                                        <thead style="background-color: #002d72;">
                                            <tr>
                                                <th scope="col">Nome</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Telefone</th>
                                                <th scope="col">Endereço</th>
                                                <th scope="col">Ações</th>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $usuarios->links() }}
        </div>
    </div>
@endsection
