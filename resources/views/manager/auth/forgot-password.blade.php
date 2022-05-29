@extends('layouts.guest')

@section('title', 'Recuperar senha')
@section('content')
<div class="d-flex h-100 flex-column justify-content-center align-items-center">
    <div class="p-4 m-2 rounded bg-white">
        @include('components.application-logo')
        <div class="mb-4 small">
            Esqueceu sua senha? Não tem problema. Basta nos informar seu e-mail e nós lhe enviaremos um link para
            redefinir sua senha.
        </div>
        @include('components.auth-session-status')
        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="list-disc list-inside small text-danger">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
            @endif
        <form class="d-flex gap-3 align-items-center flex-wrap" method="POST" action="{{ route('manager.password.email') }}">
            @csrf
            <div class="mb-3 flex-grow-1">
                <label for="email">Email</label>
                <input id="email" class="w-100 form-control" type="email" name="email" value="{{ old('email') }}"
                    required autofocus>
            </div>
            <div>
            <button type="submit" class="btn btn-primary">
                Redefinir senha
            </button>
        </div>
        </form>
    </div>
</div>
