@extends('layouts.guest')

@section('title', 'Login')
@section('content')
<div class="d-flex h-100 justify-content-center align-items-center p-3">
    <div class="bg-white rounded d-flex flex-column p-4" id="box">
        @if($errors->any())
         @include('components.auth-validation-errors')
        @endif
        <a href="/"></a>

        <h3 class="text-center fw-bold my-4">Login de professor</h3>

        <form action="{{ route('professor.login') }}" method="post">
            @csrf
            <!-- Email Address -->
            <div class="">
                <label for="email">E-mail</label>

                <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required
                    autofocus>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password">Senha</label>

                <input id="password" class="form-control" type="password" name="password" required
                    autocomplete="current-password">
            </div>

            <div class="d-flex align-items-center justify-content-between mt-4">
                <a class="text-decoration-none" href="{{ route('professor.password.request') }}">Recuperar senha?</a>

                <a class="text-decoration-none" href="{{ route('professor.register') }}">Cadastre-se</a>
            </div>

            <hr>

            <!-- Remember Me -->
            <div class="my-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="form-check-input" name="remember">

                    <span class="ms-2">Lembrar</span>
                </label>
            </div>

            <div class="text-center">
                <button class="btn btn-success w-100">Entrar</button>
            </div>
        </form>
    </div>
</div>
@endsection