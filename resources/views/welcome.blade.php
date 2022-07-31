@extends('layouts.main')
@section('title', 'Mercadorias')
@section('content')
    @if(@session('msg'))
    <p class="msg">{{ @session('msg') }}</p>
    @endif

    <table class="table table-bordered" style="width: 650px; margin-top: 3%; margin-left: 25%; text-align: center;">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th>TÍTULO</th>
                <th>VALOR</th>
                <th>CÓDIGO</th>
                <th>CATEGORIA</th>
                <th>CATEGORIA</th>
                <th>CATEGORIA</th>
                <th>EDITAR</th>
                <th>DELETAR</th>
            </tr>
        </thead>
        <tbody id="tabela">
            <tr>
                {{-- Dados vem do JavaScript --}}
            </tr>
        </tbody>
    </table>

    <div id="formEdition">
        {{--  --}}
    </div>
@endsection