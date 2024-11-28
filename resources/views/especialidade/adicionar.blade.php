@extends('components.layouts.app')

@section('title', 'Listagem de Especialidades')

@section('content')
    <form action="{{ route('especialidade.store') }}" method="POST" class="d-inline">
        @csrf

        @include('especialidade.form')
    </form>
@endsection
