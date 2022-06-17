@extends('layouts.guest')

@section('title', 'Cadastro')

@section('content')
    <div class="p-md-4 d-flex justify-content-center">
        <form class="row bg-white rounded p-4" style="max-width: 762px;" action="{{ route('student.register') }}"
            method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-12 p-0">
                @if ($errors->any())
                    @include('components.auth-validation-errors')
                @endif

                @include('components.fail')
            </div>

            <div class="col-12 my-2 p-3 border border-1">
                <h5 class="text-title">Dados pessoais</h5>
                <div class="row">
                    <!-- Name -->
                    <div class="col-12 col-md-7 mt-3">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                    </div>
                    <!-- phone -->
                    <div class="col-12 col-md-5 mt-3">
                        <label for="phone">Telefone</label>
                        <input id="phone" class="form-control" type="text" name="phone" value="{{ old('phone') }}"
                            required autofocus>
                    </div>
                </div>
                <div class="row">
                    <!-- Email Address -->
                    <div class="col-12 mt-3">
                        <label for="email">E-mail</label>
                        <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}"
                            required autofocus>
                    </div>
                </div>
            </div>

            <div class="col-12 my-2 p-3 border border-1">
                <h5 class="text-title">Dados de segurança</h5>
                <div class="row">
                    <!-- Password -->
                    <div class="col-12 col-md-6 mt-3">
                        <label for="password">Senha</label>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" id="password" name="password" required>
                            <span class="input-group-text pass"><i class="bi bi-eye-slash"></i></span>
                        </div>
                    </div>
                    <!-- Confirm Password -->
                    <div class="col-12 col-md-6 mt-3">
                        <label for="password_confirmation">Confirmar senha</label>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            <span class="input-group-text pass"><i class="bi bi-eye-slash"></i></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 my-2 p-3 border border-1">
                <h5 class="text-title">Dados acadêmicos</h5>
                <div class="row">
                    <!-- Registration -->
                    <div class="col-12 col-md-6 mt-3">
                        <label for="registration">Matrícula</label>
                        <input id="registration" class="form-control" type="text" name="registration"
                            value="{{ old('registration') }}" required autofocus>
                    </div>
                    <!-- Historic -->
                    <div class="col-12 col-md-6 mt-3">
                        <label for="historic">Histórico</label>
                        <input id="historic" class="form-control" type="file" name="historic" required autofocus>
                    </div>
                </div>
            </div>

            <div class="col-12 my-2 p-3 border border-1">
                <h5 class="text-title">Endereço</h5>
                <div class="row">
                    <!-- street -->
                    <div class="col-12 mt-3">
                        <label for="street">Rua, nº</label>
                        <input id="street" class="form-control" type="text" name="street" value="{{ old('street') }}"
                            required autofocus>
                    </div>
                </div>
                <div class="row">
                    <!-- district -->
                    <div class="col-12 col-md-6 mt-3">
                        <label for="district">Bairro</label>
                        <input id="district" class="form-control" type="text" name="district"
                            value="{{ old('district') }}" required autofocus>
                    </div>
                    <!-- city -->
                    <div class="col-12 col-md-6 mt-3">
                        <label for="city">Cidade</label>
                        <input id="city" class="form-control" type="text" name="city" value="{{ old('city') }}" required
                            autofocus>
                    </div>
                </div>
                <div class="row">
                    <!-- state -->
                    <div class="col-12 col-md-6 mt-3">
                        <label for="state">Estado</label>
                        <input id="state" class="form-control" type="text" name="state" value="{{ old('state') }}"
                            max="2" required autofocus>
                    </div>
                    <!-- zip_code -->
                    <div class="col-12 col-md-6 mt-3">
                        <label for="zip_code">CEP</label>
                        <input id="zip_code" class="form-control" type="text" name="zip_code"
                            value="{{ old('zip_code') }}" required autofocus>
                    </div>
                </div>
            </div>

            <div class="mt-3 p-0 d-flex justify-content-between align-items-center">
                <a class="text-decoration-none" href="{{ route('student.login') }}">Já está cadastrado?</a>
                <button class="btn btn-success text-decoration-none" type="submit">CADASTRAR</button>
            </div>
        </form>
    </div>

    @push('masks')
        <script>
            $(document).ready(function() {
                $('#phone').mask('(00) 00000-0000');
                $('#zip_code').mask('00000-000');
            });
        </script>
    @endpush
@endsection
