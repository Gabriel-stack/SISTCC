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
                                    <label for="phone">Telefone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{Auth::user()->phone}}" required>
                                </div>
                            </div>
                            <div class="mt-4">
                                <label for="email">Email</label>
                                <p class="form-control disabled">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-6 col-sm-5 col-md-4 mt-4">
                                    <label for="semester_origin">Semestre de Origem</label>
                                    <input type="text" class="form-control" id="semester_origin" name="semester_origin" value="{{Auth::user()->semester_origin}}" required>
                                </div>
                                {{-- <div class="col-6 col-sm-5 col-md-4 mt-4">
                                    <label for="">Ano</label>
                                    <input type="text" class="form-control" id="" name="" required>
                                </div> --}}
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
                                <label for="street">Rua, Nº</label>
                                <input type="text" class="form-control" id="street" name="street" value="{{Auth::user()->street}}" required>
                            </div>
                            <div class="row">
                                <div class="col-6 mt-4">
                                    <label for="district">Bairro</label>
                                    <input type="text" class="form-control" id="district" name="district"value="{{Auth::user()->district}}" required>
                                </div>
                                <div class="col-6 mt-4">
                                    <label for="city">Cidade</label>
                                    <input type="text" class="form-control" id="city" name="city" value="{{Auth::user()->city}}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mt-4">
                                    <label for="state">Estado</label>
                                    <input type="text" class="form-control" id="state" name="state" value="{{Auth::user()->state}}" required>
                                </div>
                                <div class="col-6 mt-4">
                                    <label for="zip_code">CEP</label>
                                    <input type="text" class="form-control" id="zip_code" name="zip_code" value="{{Auth::user()->zip_code}}" required>
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
                                <label for="attended_count_tcc">Vezes Que Cursou TCC</label>
                                <input type="number" class="form-control w-auto" id="attended_count_tcc" name="attended_count_tcc"
                                    value="{{Auth::user()->attended_count_tcc}}" required>
                            </div>
                            <div class="mt-4">
                                <label for="missing_subjects">Disciplinas Pendentes</label>
                                <textarea class="form-control" id="missing_subjects" name="missing_subjects" cols="30" rows="5">{{Auth::user()->missing_subjects}}"</textarea>
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
