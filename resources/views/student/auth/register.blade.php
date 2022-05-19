@extends('layouts.guest')

@section('content')
<div class="p-3">
    <div class="bg-white container rounded d-flex flex-column p-4 my-md-5">
        <a href="/"></a>

        <h3 class="text-center fw-bold my-4">Cadastro de Aluno</h3>

        <form class="row gap-0" action="{{ route('student.register') }}" method="post">
            @csrf
            <div class="col-12 col-md-6 mb-2">
                <!-- Name -->
                <div class="mt-4">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                </div>
                <!-- Email Address -->
                <div class="mt-4">
                    <label for="email">E-mail</label>

                    <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required
                        autofocus>
                </div>
                <!-- phone -->
                <div class="mt-4">
                    <label for="phone">Telefone</label>
                    <input id="phone" class="form-control" type="text" name="phone" value="{{ old('phone') }}" required
                        autofocus>
                </div>

                <!-- semester_origin -->
                <div class="mt-4">
                    <label for="semester_origin">Ano/Semestre de origem</label>
                    <input id="semester_origin" class="form-control" type="text" name="semester_origin"
                        value="{{ old('semester_origin') }}" required autofocus>
                </div>

                <!-- attended_count_tcc -->
                <div class="mt-4">
                    <label for="attended_count_tcc">Quantidade de vezes cursou TCCs </label>
                    <input id="attended_count_tcc" class="form-control" type="number" name="attended_count_tcc"
                        value="{{ old('attended_count_tcc') }}" required autofocus>
                </div>
                <!-- Password -->
                <div class="mt-4">
                    <label for="password">Senha</label>
                    <input id="password" class="form-control" type="password" name="password" required
                        autocomplete="current-password">
                </div>
                <!-- Confirm Password -->
                <div class="mt-4">
                    <label for="password_confirmation">Confirmar Senha</label>
                    <input id="password_confirmation" class="form-control" type="password" name="password_confirmation"
                        required>
                </div>
            </div>
            <div class="col-12 col-md-6">

                <!-- street -->
                <div class="mt-4">
                    <label for="street">Rua</label>
                    <input id="street" class="form-control" type="text" name="street" value="{{ old('street') }}" required
                        autofocus>
                </div>

                <!-- district -->
                <div class="mt-4">
                    <label for="district">Bairro</label>
                    <input id="district" class="form-control" type="text" name="district" value="{{ old('district') }}"
                        required autofocus>
                </div>

                <!-- city -->
                <div class="mt-4">
                    <label for="city">Cidade</label>
                    <input id="city" class="form-control" type="text" name="city" value="{{ old('city') }}" required
                        autofocus>
                </div>

                <!-- state -->
                <div class="mt-4">
                    <label for="state">Estado</label>
                    <input id="state" class="form-control" type="text" name="state" value="{{ old('state') }}" max="2"
                        required autofocus>
                </div>

                <!-- zip_code -->
                <div class="mt-4">
                    <label for="zip_code">CEP</label>
                    <input id="zip_code" class="form-control" type="text" name="zip_code" value="{{ old('zip_code') }}"
                        required autofocus>
                </div>
            </div>

            <div class="mt-4">
                <a class="text-decoration-none" href="{{ route('student.login') }}">Já está cadastrado?</a>
            
                <hr>

                <div class="text-center">
                    <a class="btn btn-success text-decoration-none" href="{{ route('student.register') }}">Cadastrar</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
