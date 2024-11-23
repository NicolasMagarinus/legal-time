@extends('components.layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Editar Agendamento</h1>
    <form action="{{ route('agendamento.update', $agendamento->id) }}" method="POST" class="d-inline">
        @csrf
        @method('PUT')

        @include('agendamento.form')
    </form>
</div>
@endsection
