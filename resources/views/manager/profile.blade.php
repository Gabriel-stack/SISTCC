@extends('manager.templates.panel')

@section('title', 'PERFIL')

@section('container')
    @include('components.success')
    @include('components.fail')
    @include('components.auth-validation-errors')
    
    <div class="row align-items-stretch">
        <div class="col-12 col-md-6">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title">DADOS PESSOAIS</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <form action="{{ route('manager.profile.update') }}" method="POST">
                            @csrf
                            <div class="mt-4">
                                <label for="name">Nome</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ Helper::manager()->name }}">
                            </div>
                            <div class="mt-4">
                                <label for="email">Email</label>
                                <p class="form-control disabled">{{ Helper::manager()->email }}</p>
                            </div>
                            <div class="mt-4 text-center">
                                <button type="submit" class="btn btn-success">ALTERAR</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 mt-2 mt-sm-0">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title">ALTERAR SENHA</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('manager.profile.update_password') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="mt-4">
                                <label for="password">Senha atual</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="mt-4">
                                <label for="new_password">Nova senha</label>
                                <input type="password" class="form-control" id="new_password" name="new_password"
                                    required>
                            </div>
                            <div class="mt-4">
                                <label for="new_password_confirmation">Confirmar nova senha</label>
                                <input type="password" class="form-control" id="new_password_confirmation"
                                    name="new_password_confirmation" required>
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-success">ALTERAR</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
