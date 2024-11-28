@php
    $advogadoSelecionado = isset($avaliacao->advogado_id) ? old('advogado_id', $avaliacao->advogado_id) : null;
    $comentario          = isset($avaliacao->comentario)  ? old('comentario',  $avaliacao->comentario)  : null;
    $nota                = isset($avaliacao->nota)        ? old('nota',        $avaliacao->nota)        : "";
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
            <label for="advogado_id">Advogado: *</label>
            <select name="advogado_id" class="form-control" required>
                <option value="">Selecione um advogado</option>
                @foreach($advogados as $id => $nome)
                    <option value="{{ $id }}" {{ $id == $advogadoSelecionado ? 'selected' : '' }}>{{ $nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="comentario">Comentário: *</label>
            <input type="text" name="comentario" class="form-control" value="{{ $comentario }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="nota">Nota: *</label>
            <input type="numeric" name="nota" class="form-control" value="{{ $nota }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('avaliacao.index') }}" class="btn btn-secondary">Cancelar</a>
    </div>
</div>
