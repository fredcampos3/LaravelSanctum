@extends('layouts.app')

@section('title', 'Criar Conta')

@section('content')
<div class="jumbotron">
    <h1 class="display-4">Bem-vindo!</h1>
    <p class="lead">Cadastre-se para descobrir tudo o que temos a oferecer. Estamos felizes em tê-lo aqui!</p>
    <hr class="my-4">
    <div class="row">
        <div class="col-md-12">
            <form id="registerForm">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nome Completo</label>
                    <input type="text" id="name" name="name" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirme a Senha</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="cep" class="form-label">CEP</label>
                    <input type="text" id="cep" name="cep" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="street" class="form-label">Rua</label>
                    <input type="text" id="street" name="street" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="neighborhood" class="form-label">Bairro</label>
                    <input type="text" id="neighborhood" name="neighborhood" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="number" class="form-label">Número</label>
                    <input type="text" id="number" name="number" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">Cidade</label>
                    <input type="text" id="city" name="city" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="state" class="form-label">Estado</label>
                    <input type="text" id="state" name="state" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </form>
        </div>
    </div>
</div>
@endsection
