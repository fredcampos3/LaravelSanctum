@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="jumbotron">
        <h1 class="display-4 display-name">Bem-vindo, </h1>
        <p class="lead">Listando todos os usuários cadastrados com <strong>Sanctum</strong>!</p>
        <hr class="my-4">
        <div class="row" id="listUsers">
        </div>
    </div>
@endsection
