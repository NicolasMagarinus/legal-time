@extends('components.layouts.app')

@section('title', 'Listagem de Agendamentos')

@section('content')
    <form action="{{ route('agendamento.store') }}" method="POST" class="d-inline">
        @csrf

        @include('agendamento.form')
    </form>
@endsection
