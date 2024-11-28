@php
    $descricao = (isset($especialidade->descricao) ? old('descricao', $especialidade->descricao): "")
@endphp

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
        <div class="form-group mb-3">
            <label for="descricao">Descrição: *</label>
            <input type="text" name="descricao" class="form-control" value="{{ $descricao }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('especialidade.index') }}" class="btn btn-secondary">Cancelar</a>
    </div>
</div>
