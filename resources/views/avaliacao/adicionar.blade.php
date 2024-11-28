@extends('components.layouts.app')

@section('title', 'Listagem de Avaliações')

@section('content')
    <form action="{{ route('avaliacao.store') }}" method="POST" class="d-inline">
        @csrf

        @include('avaliacao.form')
    </form>
@endsection
