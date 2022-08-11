@extends('layouts.guest')

@section('title', 'Login')

@section('content')
    <style>
        body {
            background-color: rgb(229, 229, 229) !important;
        }
    </style>

    <div class="d-flex h-100 justify-content-center align-items-center p-3">
        <div class="bg-white rounded d-flex flex-column p-4" id="box">
            <div class="mx-auto mb-4" style="max-width: 300px;">
                @include('components.application-logo')
            </div>

            @if ($errors->any())
            @include('components.auth-validation-errors')
            @endif

            @include('components.fail')

            <form action="{{ route('manager.login') }}" method="post">
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
                    <div class="input-group mb-3">
                        <input id="password" class="form-control" type="password" name="password" required
                            autocomplete="current-password">
                        <span class="input-group-text pass"><i class="bi bi-eye-slash"></i></span>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button class="btn btn-success w-100">ENTRAR</button>
                </div>

                <div class="d-flex align-items-center justify-content-between mt-4">
                    <a class="text-decoration-none" href="{{ route('manager.password.request') }}">Recuperar senha?</a>
                    <a class="text-decoration-none" href="{{ route('student.login') }}">Acesso de Aluno</a>
                </div>
            </form>
        </div>
    </div>
@endsection
