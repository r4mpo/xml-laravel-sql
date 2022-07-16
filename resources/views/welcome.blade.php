@extends('layouts.main')
@section('title', 'MEDJUDIC')
@section('content')
@if(@session('msg'))
  <p class="msg">{{ @session('msg') }}</p>
@endif
<table class="table table-bordered" style="width: 650px; margin-top: 3%; margin-left: 25%; text-align: center;">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th>NUM-PROC-JUD</th>
            <th>VARA</th>
            <th>SEC-JUD</th>
            <th>SUB-SEC-JUD</th>
            <th>dt-Concessao</th>
        </tr>
    </thead>

    <tbody>
        @foreach($mjdc as $m)
        <tr>
            <th scope="row">{{ $m->id }}</th>
            <td>{{ $m->NumProcJud }}</td>
            <td>{{ $m->Vara }}</td>
            <td>{{ $m->SecJud }}</td>
            <td>{{ $m->SubSecJud }}</td>                
            <td>{{ $m->dtConcessao }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection