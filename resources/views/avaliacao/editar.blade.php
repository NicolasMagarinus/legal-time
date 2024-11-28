@extends('components.layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Editar Avaliação</h1>
    <form action="{{ route('avaliacao.update', $avaliacao->id) }}" method="POST" class="d-inline">
        @csrf
        @method('PUT')

        @include('avaliacao.form')
    </form>
</div>
@endsection
