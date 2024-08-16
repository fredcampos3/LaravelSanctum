@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="jumbotron">
        <h1 class="display-4">Recuperar Senha!</h1>
        <p class="lead">Envie um e-mail de recuperação de senha!</p>
        <hr class="my-4">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" id="forgotPasswordForm">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar link de recuperação</button>
                </form>
            </div>
        </div>
    </div>
@endsection
