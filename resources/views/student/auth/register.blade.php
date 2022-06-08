@extends('layouts.guest')

@section('title', 'Cadastro')
@section('content')
<div class="p-3">
    @if ($errors->any())
    @include('components.auth-validation-errors')
    @endif
    @include('components.fail')
    <a href="/"></a>


    <form class="row gap-1 bg-white rounded p-4 my-md-5" action="{{ route('student.register') }}" method="post">
        @csrf
            <div class="col-12 col-sm-5 my-2 p-3 border border-1">
                <h5 class="text-title">Contato</h5>
                <div class="row">
                    <!-- Name -->
                    <div class="col-12 col-md-7 mt-3">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required
                            autofocus>
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
                <div class="row ">
                    <h5 class="text-title mt-2">Segurança</h5>
                    <div class="row">
                        <!-- Password -->
                        <div class="col-12 col-md-6 mt-3">
                            <label for="password">Senha</label>
                            <input id="password" class="form-control" type="password" name="password" required
                                autocomplete="current-password">
                        </div>
                        <!-- Confirm Password -->
                        <div class="col-12 col-md-6 mt-3">
                            <label for="password_confirmation">Confirmar Senha</label>
                            <input id="password_confirmation" class="form-control" type="password"
                                name="password_confirmation" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 my-2 p-3 border border-1">
                <h5 class="text-title">Endereço</h5>
                <div class="row">
                    <!-- street -->
                    <div class="col-12 mt-3">
                        <label for="street">Rua</label>
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

        <div class="mt-4">
            <a class="text-decoration-none" href="{{ route('student.login') }}">Já está cadastrado?</a>

            <hr>

            <div class="text-end">
                <button class="btn btn-success text-decoration-none" type="submit">Cadastrar</button>
            </div>
        </div>
    </form>
</div>
@endsection