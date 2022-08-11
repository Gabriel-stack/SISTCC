@extends('manager.templates.panel')

@section('title', 'Perfil')

@section('container')
<div class="col-12">
    @include('components.success')
    @include('components.fail')
    @include('components.auth-validation-errors')
</div>

<div class="d-flex flex-wrap align-items-stretch">
    <div class="col-12 col-lg-6 pb-2 px-2">
        <div class="card bg-gray-400 box-shadow rounded-2 h-100">
            <div class="card-body">
                <div class="form-group h-100">
                    <form class="d-flex flex-column justify-content-between h-100"
                        action="{{ route('manager.profile.update') }}" method="POST">
                        @csrf
                        <div>
                            <h5 class="card-title">Dados pessais</h5>
                            <div class="mt-3">
                                <label for="name">Nome</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ Helper::manager()->name }}">
                            </div>
                            <div class="mt-3">
                                <label for="email">Email</label>
                                <p class="form-control bg-gray m-0">{{ Helper::manager()->email }}</p>
                            </div>
                        </div>
                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-success">ALTERAR</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6 pb-2 px-2">
        <div class="card bg-gray-400 box-shadow rounded-2 h-100">
            <div class="card-body">
                <form action="{{ route('manager.profile.update_password') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <h5 class="card-title">Alterar senha</h5>
                        <div class="mt-3">
                            <label for="password">Senha atual</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" id="password" name="password">
                                <span class="input-group-text pass"><i class="bi bi-eye-slash"></i></span>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label for="new_password">Nova senha</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" id="new_password" name="new_password"
                                    required>
                                <span class="input-group-text pass"><i class="bi bi-eye-slash"></i></span>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label for="new_password_confirmation">Confirmar nova senha</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" id="new_password_confirmation"
                                    name="new_password_confirmation" required>
                                <span class="input-group-text pass"><i class="bi bi-eye-slash"></i></span>
                            </div>
                        </div>
                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-success">ALTERAR</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="my-2 px-2">
        <a class="btn btn-secondary text-white" href="{{ route('manager.dashboard') }}">VOLTAR</a>
    </div>
</div>
@endsection