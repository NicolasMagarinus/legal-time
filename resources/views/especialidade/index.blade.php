@extends('components.layouts.app')

@section('title', 'Listagem de Especialidades')

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
            <h1 class="h3">Listagem de Avaliações</h1>
            <a href="{{ route('especialidade.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Adicionar
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr class="bg-light">
                        <th scope="col">Descrição</th>
                        <th scope="col" class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody id="user-table">
                    @forelse($especialidades as $especialidade)
                        <tr>
                            <td>{{ $especialidade->descricao }}</td>
                            <td class="text-center">
                                <a href="{{ route('especialidade.show', $especialidade->id) }}" class="btn btn-info btn-sm" title="Informações">
                                    <i class="fas fa-solid fa-bars"></i>
                                </a>
                                <a href="{{ route('especialidade.edit', $especialidade->id) }}" class="btn btn-warning btn-sm" title="Editar">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <button
                                    class="btn btn-danger btn-sm btn-delete"
                                    data-id="{{ $especialidade->id }}"
                                    title="Excluir">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                <form action="{{ route('especialidade.destroy', $especialidade->id) }}"
                                      method="POST"
                                      id="form-delete-{{ $especialidade->id }}"
                                      class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Nenhuma especialidade encontrada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
