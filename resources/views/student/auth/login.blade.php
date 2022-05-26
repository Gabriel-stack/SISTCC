@extends('layouts.guest')

@section('title', 'Login')
@section('content')
    <div class="d-flex h-100 justify-content-center align-items-center p-3">
        <div class="bg-white rounded d-flex flex-column p-4" id="box">
            @include('components.application-logo')
            @if ($errors->any())
                @include('components.auth-validation-errors')
            @endif
            @include('components.fail')
            <a href="/"></a>

            <form action="{{ route('student.login') }}" method="post">
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
                    <a class="text-decoration-none" href="{{ route('student.password.request') }}">Recuperar senha?</a>

                    <a class="text-decoration-none" href="{{ route('student.register') }}">Cadastre-se</a>
                </div>

                <hr>

                <!-- Remember Me -->
                <div class="d-flex justify-content-between my-4">
                    <label for="remember_me">
                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                        <span class="ms-2">Lembrar-me</span>
                    </label>

                    <a class="text-decoration-none" href="{{ route('professor.login') }}">Acesso de Professor</a>
                </div>

                <div class="text-center">
                    <button class="btn btn-success w-100">Entrar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
