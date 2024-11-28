@extends('components.layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Editar Especialidade</h1>
    <form action="{{ route('especialidade.update', $especialidade->id) }}" method="POST" class="d-inline">
        @csrf
        @method('PUT')

        @include('especialidade.form')
    </form>
</div>
@endsection
