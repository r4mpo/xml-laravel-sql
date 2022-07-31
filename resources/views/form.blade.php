@extends('layouts.main')
@section('title', 'Mercadorias')
@section('content')

<form action="/mercadorias/store" method="post" style="width: 25%; margin-left: 40%; margin-top: 5%;">
    @csrf
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1"><ion-icon name="key-outline"></ion-icon></span>
        <input type="number" class="form-control" id="id" name="id" placeholder="ID" aria-label="Username" aria-describedby="basic-addon1">
        <button type="button" onclick="geracaoAutomatica('id')" class="btn btn-outline-dark">Geração Automática</button>
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1"><ion-icon name="information-circle-outline"></ion-icon></span>
        <input type="text" class="form-control" name="title" placeholder="TITLE" aria-label="Username" aria-describedby="basic-addon1">
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1"><ion-icon name="logo-usd"></ion-icon></span>
        <input type="number" step=".01" class="form-control" name="value" placeholder="VALUE" aria-label="Username" aria-describedby="basic-addon1">
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1"><ion-icon name="extension-puzzle-outline"></ion-icon></span>
        <select class="form-select" id="selectCategoria" name="fk_categoria_1" aria-label="Default select example">
            {{--  --}}
        </select>
        <button type="button" onclick="adicionarCampo()" class="btn btn-outline-dark">Adicionar</button>
    </div>
    
    <div class="input-group mb-3" id="adicionarCategoriaCampo">
        {{--  --}}
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1"><ion-icon name="extension-puzzle-outline"></ion-icon></span>
        <select class="form-select" id="selectCategoria" name="loteSelecionado" aria-label="Default select example">
            <option value="" selected>Selecione um lote</option>
            @foreach($lote as $l)
                <option value="{{ $l->id }}">{{ $l->title }}</option>
            @endforeach
        </select>
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1"><ion-icon name="receipt-outline"></ion-icon></span>
        <input type="number" class="form-control" onchange="disabledCb()" id="codigo" name="codigo" placeholder="Código" aria-label="Username" aria-describedby="basic-addon1">
        <div class="input-group-text">
            <input class="form-check-input mt-0" id="cbGeracaoAutomatica" type="checkbox" onclick="geracaoAutomatica('codigo')" aria-label="Checkbox for following text input">
        </div>
        </div>

    <button type="submit" class="btn btn-outline-success">Cadastrar</button>

</form>

<script src="/js/requisicoes.js"></script>
<script>

    buscarCategorias('selectCategoria')

    let i = 0 // Conta quantos campos foram adicionados
    let y = 2 // Serve para diferenciar os campos

    function adicionarCampo(){
        if(i < 2){
            var adicionarCategoriaCampo = document.getElementById('adicionarCategoriaCampo')
            let novaCategoria =
            `<div class="input-group mb-3" id="adicionarCategoriaCampo${y}">
                <span class="input-group-text" id="basic-addon1"><ion-icon name="extension-puzzle-outline"></ion-icon></span>
                <select class="form-select" id="selectCategoria${y}" name="fk_categoria_${y}" aria-label="Default select example">
                    
                </select>
                <button type="button" onclick="removerCampo('adicionarCategoriaCampo${y}', ${y})" class="btn btn-outline-dark">Remover</button>
            </div>`
            adicionarCategoriaCampo.innerHTML += novaCategoria

            // Insere categorias nos 2 últimos campos
            buscarCategorias("selectCategoria" + y)
            buscarCategorias("selectCategoria" + (y - 1))
            y++;
            i++;
        }else{
            alert('Erro. Apenas 3 campos de categorias são permitidos')
        }
    }

    function removerCampo(x, b){
        if(i == (b - 1)){
            CampoSelecionado = document.getElementById(x)
            CampoSelecionado.remove()
            i--;
            y--;
        }else{
            alert('Erro. Não é possível excluir esse campo.')
        }
    }
</script>
@endsection