@extends('layouts.main')
@section('title', 'Mercadorias')
@section('content')

<form action="/mercadorias/update" method="post" style="width: 25%; margin-left: 40%; margin-top: 3%;">
    @csrf
    @method('PUT')
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1"><ion-icon name="key-outline"></ion-icon></span>
        <input type="number" value="{{ $mercadoria->id }}" class="form-control" id="id" name="id" placeholder="ID" aria-label="Username" aria-describedby="basic-addon1">
        <button type="button" onclick="geracaoAutomatica('id')" class="btn btn-outline-dark">Geração Automática</button>
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1"><ion-icon name="information-circle-outline"></ion-icon></span>
        <input type="text" value="{{ $mercadoria->title }}" class="form-control" name="title" placeholder="TITLE" aria-label="Username" aria-describedby="basic-addon1">
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1"><ion-icon name="logo-usd"></ion-icon></span>
        <input type="number" value="{{ $mercadoria->value }}" step=".01" class="form-control" name="value" placeholder="VALUE" aria-label="Username" aria-describedby="basic-addon1">
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1"><ion-icon name="extension-puzzle-outline"></ion-icon></span>
        <select class="form-select" id="selectCategoria" name="fk_categoria_1" aria-label="Default select example">
            <option value="{{ $mercadoria->fk_categoria_1 }}" selected>{{ $mercadoria->fk_categoria_1 }}</option>
            {{--  --}}
        </select>
    </div>

    {{-- Verifica se o campo está preenchido. Se estiver,
        oferece a opção de editá-lo --}}
    @if(!is_null($mercadoria->fk_categoria_2))
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><ion-icon name="extension-puzzle-outline"></ion-icon></span>
            <select class="form-select" id="selectCategoria2" name="fk_categoria_2" aria-label="Default select example">
                <option value="{{ $mercadoria->fk_categoria_2 }}" selected>{{ $mercadoria->fk_categoria_2 }}</option>
                {{--  --}}
            </select>
        </div>
    @endif

    {{-- Verifica se o campo está preenchido. Se estiver,
    oferece a opção de editá-lo --}}
    @if(!is_null($mercadoria->fk_categoria_3))
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><ion-icon name="extension-puzzle-outline"></ion-icon></span>
            <select class="form-select" id="selectCategoria" name="fk_categoria_3" aria-label="Default select example">
                <option value="{{ $mercadoria->fk_categoria_3 }}" selected>{{ $mercadoria->fk_categoria_3 }}</option>
                {{--  --}}
            </select>
        </div>
    @endif

    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1"><ion-icon name="podium-outline"></ion-icon></span>
        <select class="form-select" name="loteSelecionado" aria-label="Default select example" disabled>
            @foreach($lote as $l)
                <option selected>{{ $l->title }}</option>
            @endforeach
        </select>
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1"><ion-icon name="receipt-outline"></ion-icon></span>
        <input type="number" value="{{ $mercadoria->codigo }}" class="form-control" onchange="disabledCb()" id="codigo" name="codigo" placeholder="Código" aria-label="Username" aria-describedby="basic-addon1">
        <div class="input-group-text">
            <input class="form-check-input mt-0" id="cbGeracaoAutomatica" type="checkbox" onclick="geracaoAutomatica('codigo')" aria-label="Checkbox for following text input">
        </div>
        </div>

    <button type="submit" class="btn btn-outline-success">Editar</button>
</form>

<script src="/js/requisicoes.js"></script>
<script>
    buscarCategorias('selectCategoria') // Buscando categorias
    disabledCb() // Desabilitando, caso necessário, o checkbox
</script>
@endsection