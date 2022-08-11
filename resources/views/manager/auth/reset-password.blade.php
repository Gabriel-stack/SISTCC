@extends('layouts.guest')

@section('title', 'Redefinir senha')

@section('content')
    {{-- <style>
        body {
            background-color: rgb(229, 229, 229) !important;
        }
    </style> --}}
    <div class="d-flex h-100 flex-column justify-content-center align-items-center">
        <div class="p-4 m-2 rounded bg-white" id="box">
            <div class="mx-auto mb-4" style="max-width: 300px;">
                @include('components.application-logo')
            </div>

            <div class="small mb-3">
                Digite seu e-mail, a nova senha e confirme a senha.
            </div>

            @include('components.auth-session-status')

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-disc list-inside small text-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="d-flex flex-column" method="POST" action="{{ route('manager.password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <div class="col-12 mb-3">
                    <label for="email">Email</label>
                    <input id="email" class="w-100 form-control" type="email" name="email" value="{{ old('email', $request->email) }}"
                        required autofocus>
                </div>
                <div class="col-12 mb-3">
                    <label for="password">Senha</label>
                    <input id="password" class="w-100 form-control" type="password" name="password" value="{{ old('password', $request->password) }}"
                        required autofocus>
                </div>
                <div class="col-12 mb-3">
                    <label for="password_confirmation">Confirmar senha</label>
                    <input id="password_confirmation" class="w-100 form-control" type="password" name="password_confirmation" value="{{ old('password_confirmation', $request->password_confirmation) }}"
                        required autofocus>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-success w-100">
                        ALTERAR SENHA
                    </button>
                </div>
                <!-- Access Professor -->
                <div class="d-flex justify-content-between mt-3">
                    <a class="text-decoration-none" href="{{ route('manager.login') }}">Voltar</a>
                </div>
            </form>
        </div>
    </div>
@endsection
