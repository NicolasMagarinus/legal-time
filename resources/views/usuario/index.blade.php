@extends('components.layouts.app')

@section('title', 'Listagem de Usuários')

@section('content')
    <div class="container mt-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Listagem de Usuários</h1>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
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
                    @forelse($usuarios as $usuario)
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
                                <button
                                    class="btn btn-danger btn-sm btn-delete"
                                    data-id="{{ $usuario->id }}"
                                    title="Excluir">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                <form action="{{ route('usuario.destroy', $usuario->id) }}"
                                      method="POST"
                                      id="form-delete-{{ $usuario->id }}"
                                      class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Nenhum usuário encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const delBtn = document.querySelectorAll('.btn-delete');
                delBtn.forEach(button => {
                    button.addEventListener('click', function () {
                        const id = this.getAttribute('data-id');
                        Swal.fire({
                            title: 'Você tem certeza?',
                            text: 'Esta ação não pode ser desfeita!',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Sim, excluir!',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.getElementById(`form-delete-${id}`).submit();
                            }
                        });
                    });
                });
            });
        </script>
    @endpush
@endsection
