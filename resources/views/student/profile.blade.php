@extends('student.templates.panel')

@section('title', 'PERFIL')

@section('container')

    @include('components.success')
    @include('components.fail')
    @include('components.auth-validation-errors')

    <div class="row align-items-stretch">
        <div class="col-12 col-md-6 mt-2 mt-sm-0 py-3">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title">DADOS PESSOAIS</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <form action="{{ route('student.profile.update') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-7 mt-4">
                                    <label for="name">Nome</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ Auth::user()->name }}">
                                </div>
                                <div class="col-5 mt-4">
                                    <label for="">Telefone</label>
                                    <input type="text" class="form-control" id="" name="" required> {{-- Inserir o name --}}
                                </div>
                            </div>
                            <div class="mt-4">
                                <label for="email">Email</label>
                                <p class="form-control disabled">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-6 col-sm-5 col-md-4 mt-4">
                                    <label for="">Semestre de Origem</label>
                                    <input type="text" class="form-control" id="" name="" required> {{-- Inserir o name --}}
                                </div>
                                <div class="col-6 col-sm-5 col-md-4 mt-4">
                                    <label for="">Ano</label>
                                    <input type="text" class="form-control" id="" name="" required> {{-- Inserir o name --}}
                                </div>
                            </div>
                            <div class="mt-4 text-center">
                                <button type="submit" class="btn btn-success">ALTERAR</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 mt-2 mt-sm-0 py-3">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title">ENDEREÇO</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('student.profile.update_endereco') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="mt-4">
                                <label for="">Rua, Nº</label>
                                <input type="text" class="form-control" id="" name=""> {{-- Inserir o name --}}
                            </div>
                            <div class="row">
                                <div class="col-6 mt-4">
                                    <label for="">Bairro</label>
                                    <input type="text" class="form-control" id="" name="" required> {{-- Inserir o name --}}
                                </div>
                                <div class="col-6 mt-4">
                                    <label for="">Cidade</label>
                                    <input type="text" class="form-control" id="" name="" required> {{-- Inserir o name --}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mt-4">
                                    <label for="">Estado</label>
                                    <input type="text" class="form-control" id="" name="" required> {{-- Inserir o name --}}
                                </div>
                                <div class="col-6 mt-4">
                                    <label for="">CEP</label>
                                    <input type="text" class="form-control" id="" name="" required> {{-- Inserir o name --}}
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-success">ALTERAR</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 mt-2 mt-sm-0 py-3">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title">TCC</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('student.profile.update_tcc') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="mt-4">
                                <label for="">Vezes Que Cursou TCC</label>
                                <input type="number" class="form-control w-auto" id="" name=""> {{-- Inserir o name --}}
                            </div>
                            <div class="mt-4">
                                <label for="">Disciplinas Pendentes</label>
                                <textarea class="form-control" id="" name="" cols="30" rows="5"></textarea> {{-- Inserir o name --}}
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-success">ALTERAR</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 mt-2 mt-sm-0 py-3">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title">ALTERAR SENHA</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('student.profile.update_password') }}" method="POST">
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
