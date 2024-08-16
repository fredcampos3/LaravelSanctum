@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="jumbotron">
        <h1 class="display-4">Bem-vindo!</h1>
        <p class="lead">Acesse sua conta ou cadastre-se para descobrir tudo o que temos a oferecer. Estamos felizes em tê-lo aqui!</p>
        <hr class="my-4">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" id="resetPasswordForm">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ $email ?? old('email') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Nova Senha</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirme a Nova Senha</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Redefinir Senha</button>
                </form>
            </div>
        </div>
    </div>
@endsection
