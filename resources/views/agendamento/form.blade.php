@php
    $advogadoSelecionado = isset($agendamento->advogado_id) ? old('advogado_id', $agendamento->advogado_id) : null;
    $status              = isset($agendamento->status)      ? old('status',      $agendamento->status)      : null;
    $data                = isset($agendamento->data)        ? old('data',        $agendamento->data)        : "";
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
            <label for="data">Data: *</label>
            <input type="datetime-local" name="data" class="form-control" value="{{ $data }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="status">Status: *</label>
            <select name="status" class="form-control" required>
                <option value="">Selecione o status</option>
                <option value="1" {{ $status == '1' ? 'selected' : '' }}>Pendente</option>
                <option value="2" {{ $status == '2' ? 'selected' : '' }}>Concluído</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('agendamento.index') }}" class="btn btn-secondary">Cancelar</a>
    </div>
</div>
