@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="jumbotron">
        <h1 class="display-4">Bem-vindo!</h1>
        <p class="lead">Acesse sua conta ou cadastre-se para descobrir tudo o que temos a oferecer. Estamos felizes em tê-lo aqui!</p>
        <hr class="my-4">
        <div class="row">
            <div class="col-md-12">
                <form id="loginForm">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" id="email" name="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <a href="{{ route('password.request') }}" class="card-link">Esqueceu sua senha?</a>
                    </div>
                    <button type="submit" class="btn btn-info submit">Entrar</button>
                    <a href="{{ route('register') }}" class="btn btn-secondary submit">Criar Conta</a>
                </form>
            </div>
        </div>
    </div>
@endsection
