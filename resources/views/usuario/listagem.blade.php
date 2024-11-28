@extends('components.layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('usuario.index') }}" class="btn btn-light">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </a>
            <form action="{{ route('usuario.destroy', $usuario->id) }}" method="POST" class="d-inline" id="delete-form">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-danger btn-delete">
                    <i class="fa-solid fa-trash"></i> Excluir
                </button>
            </form>
        </div>

        <h1 class="my-4 text-center">Detalhes do Usuário</h1>

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
                <div class="mb-3">
                    <label for="nome" class="form-label"><strong>Nome:</strong></label>
                    <input type="text" id="nome" class="form-control" value="{{ $usuario->nome }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label"><strong>Email:</strong></label>
                    <input type="text" id="email" class="form-control" value="{{ $usuario->email }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="telefone" class="form-label"><strong>Telefone:</strong></label>
                    <input type="text" id="telefone" class="form-control" value="{{ $usuario->telefone }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="endereco" class="form-label"><strong>Endereço:</strong></label>
                    <input type="text" id="endereco" class="form-control" value="{{ $usuario->endereco }}" disabled>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const deleteButton = document.querySelector('.btn-delete');
                const deleteForm = document.getElementById('delete-form');

                deleteButton.addEventListener('click', function () {
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
                            deleteForm.submit();
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
