@extends('components.layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('avaliacao.index') }}" class="btn btn-light">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </a>
            <form action="{{ route('avaliacao.destroy', $avaliacao->id) }}" method="POST" class="d-inline" id="delete-form">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-danger btn-delete">
                    <i class="fa-solid fa-trash"></i> Excluir
                </button>
            </form>
        </div>

        <h1 class="my-4 text-center">Detalhes da Avaliação</h1>

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
                    <label for="advogado" class="form-label"><strong>Advogado:</strong></label>
                    <input type="text" id="advogado" class="form-control" value="{{ $advogado->nome }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="comentario" class="form-label"><strong>Comentário:</strong></label>
                    <input type="text" id="comentario" class="form-control" value="{{ $avaliacao->comentario }}" disabled>
                </div>
                <div class="mb-3">
                    <label for="nota" class="form-label"><strong>Nota:</strong></label>
                    <input type="text" id="nota" class="form-control" value="{{ $avaliacao->nota }}" disabled>
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
