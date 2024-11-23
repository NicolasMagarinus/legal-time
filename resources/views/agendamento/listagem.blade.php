@php
    $status = ($agendamento->status == 1 ? 'Pendente' : 'Concluído');
@endphp

@extends('components.layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Detalhes do Agendamento</h1>

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
                <p class="card-text"><strong>Advogado:</strong> {{ $advogado->nome }}</p>
                <p class="card-text"><strong>Data:</strong>     {{ $data }}</p>
                <p class="card-text"><strong>Status:</strong>   {{ $status }}</p>
                <a href="{{ route('agendamento.index') }}"><i class="fa-solid fa-arrow-left"></i></a>
                <form action="{{ route('agendamento.destroy', $agendamento->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Tem certeza que deseja excluir este agendamento?')"><i class="fa-solid fa-trash"></i></button>
                </form>
            </div>
        </div>
    </div>
@endsection
