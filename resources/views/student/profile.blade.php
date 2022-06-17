@extends('student.templates.panel')

@section('title', 'Perfil')

@section('container')
<div class="col-12">
    @include('components.success')
    @include('components.fail')
    @include('components.auth-validation-errors')
</div>

<div class="d-flex flex-wrap justify-content-around">
    <div class="col-12 mt-2 mt-sm-0 py-2 px-2">
        <div class="card bg-gray-400 box-shadow rounded-2 h-100">
            <div class="card-body">
                <h5 class="card-title m-0">Dados pessoais</h5>
                <div class="form-group">
                    <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-7 mt-4">
                                <label for="name">Nome</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ Auth::user()->name }}">
                            </div>
                            <div class="col-5 mt-4">
                                <label for="phone">Telefone</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="{{Auth::user()->phone}}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-7 mt-4">
                                <label for="email">Email</label>
                                <p class="form-control bg-gray m-0">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="col-12 col-sm-6 col-md-5 mt-4">
                                <label for="registration">Matrícula</label>
                                <p class="form-control bg-gray m-0">{{ Auth::user()->registration }}</p>
                            </div>
                            <div class="col-12 col-sm-6 col-md-7 col-lg-5 col-xl-4 mt-4">
                                <label for="historic">Histórico</label>
                                <input type="file" class="form-control" id="historic" name="historic"
                                    value="{{ Auth::user()->historic }}">
                            </div>
                        </div>
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-success">ALTERAR</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6 mt-2 mt-sm-0 py-2 px-2">
        <div class="card bg-gray-400 box-shadow rounded-2 h-100">
            <div class="card-body">
                <h5 class="card-title m-0">Endereço</h5>
                <form action="{{ route('student.profile.update_address') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="mt-4">
                                <label for="street">Rua, Nº</label>
                                <input type="text" class="form-control" id="street" name="street"
                                    value="{{Auth::user()->street}}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mt-4">
                                <label for="district">Bairro</label>
                                <input type="text" class="form-control" id="district" name="district"
                                    value="{{Auth::user()->district}}" required>
                            </div>
                            <div class="col-6 mt-4">
                                <label for="city">Cidade</label>
                                <input type="text" class="form-control" id="city" name="city"
                                    value="{{Auth::user()->city}}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mt-4">
                                <label for="state">Estado</label>
                                <input type="text" class="form-control" id="state" name="state"
                                    value="{{Auth::user()->state}}" maxlength="2" required>
                            </div>
                            <div class="col-6 mt-4">
                                <label for="zip_code">CEP</label>
                                <input type="text" class="form-control" id="zip_code" name="zip_code"
                                    value="{{Auth::user()->zip_code}}" required>
                            </div>
                        </div>
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-success">ALTERAR</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6 mt-2 mt-sm-0 py-2 px-2">
        <div class="card bg-gray-400 box-shadow rounded-2 h-100">
            <div class="card-body">
                <h5 class="card-title m-0">Alterar senha</h5>
                <form action="{{ route('student.profile.update_password') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="mt-4">
                            <label for="password">Senha atual</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" id="password" name="password">
                                <span class="input-group-text pass"><i class="bi bi-eye-slash"></i></span>
                            </div>
                        </div>
                        <div class="mt-4">
                            <label for="new_password">Nova senha</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" id="new_password" name="new_password"
                                    required>
                                <span class="input-group-text pass"><i class="bi bi-eye-slash"></i></span>
                            </div>
                        </div>
                        <div class="mt-4">
                            <label for="new_password_confirmation">Confirmar nova senha</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" id="new_password_confirmation"
                                    name="new_password_confirmation" required>
                                <span class="input-group-text pass"><i class="bi bi-eye-slash"></i></span>
                            </div>
                        </div>
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-success">ALTERAR</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 my-2 px-2">
        <a class="btn btn-secondary" href="{{ route('student.dashboard') }}">VOLTAR</a>
    </div>
</div>
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
    $(document).ready(function () {
            $('#phone').mask('(00) 00000-0000');
            $('#zip_code').mask('00000-000');
        });
</script>
@endsection
@endsection