@extends('layouts.guest')

@section('title', 'Recuperar senha')

@section('content')
    <div class="d-flex h-100 flex-column justify-content-center align-items-center">
        <div class="p-4 m-2 rounded bg-white" id="box">
            <div class="mx-auto mb-4" style="max-width: 300px;">
                @include('components.application-logo')
            </div>

            <div class="small">
                Digite seu e-mail e enviaremos um link para redefinir sua senha.
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

            <form class="d-flex flex-column" method="POST"
                action="{{ route('manager.password.email') }}">
                @csrf
                <div class="col-12 my-3">
                    <label for="email">Email</label>
                    <input id="email" class="w-100 form-control" type="email" name="email" value="{{ old('email') }}"
                        required autofocus>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-success w-100">
                        Confirmar
                    </button>
                </div>
                <!-- Access Aluno -->
                <div class="d-flex justify-content-between mt-3">
                    <a class="text-decoration-none" href="{{ route('manager.login') }}">Voltar</a>
                </div>
            </form>
        </div>
    </div>
@endsection
