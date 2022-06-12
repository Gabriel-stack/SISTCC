@extends('manager.templates.panel')

@section('title', 'Perfil')

@section('container')
    @include('components.success')
    @include('components.fail')
    @include('components.auth-validation-errors')

    <div class="d-flex flex-wrap justify-content-center">
        <div class="row col-12 col-sm-11 align-items-stretch">
            <div class="col-12 col-lg-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="form-group h-100">
                            <form class="d-flex flex-column justify-content-between h-100" action="{{ route('manager.profile.update') }}" method="POST">
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
            <div class="col-12 col-lg-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <form action="{{ route('manager.profile.update_password') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <h5 class="card-title">Alterar senha</h5>
                                <div class="mt-3">
                                    <label for="password">Senha atual</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                                <div class="mt-3">
                                    <label for="new_password">Nova senha</label>
                                    <input type="password" class="form-control" id="new_password" name="new_password"
                                        required>
                                </div>
                                <div class="mt-3">
                                    <label for="new_password_confirmation">Confirmar nova senha</label>
                                    <input type="password" class="form-control" id="new_password_confirmation"
                                        name="new_password_confirmation" required>
                                </div>
                                <div class="text-end mt-3">
                                    <button type="submit" class="btn btn-success">ALTERAR</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <a class="btn btn-secondary text-white" href="{{ route('manager.dashboard') }}">VOLTAR</a>
            </div>
        </div>
    </div>
@endsection
