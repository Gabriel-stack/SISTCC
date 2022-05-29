@extends('student.templates.panel')

@section('title', 'Turmas')

@section('container')

@include('components.success')
@include('components.fail')
@include('components.auth-validation-errors')

<div class="my-4 text-center">
    <h1 class="display-5">Você não está cadastrado em nenhuma turma!</h1>
    <span class="h4 fw-light">Realize seu cadastro em uma turma disponível </span>
</div>

<div class="my-3">
    <h3 class="d-inline fw-bold">Turmas disponíveis</h3>
    <div class="d-flex py-3">
        <div class="card student-subjects box-shadow">
            <div class="card-body">
                <h3 class="card-title">2022.1</h3>
                <p class="card-text">cursando</p>
                <form class="text-end" action="">
                    <button class="btn btn-success" type="submit">ENTRAR</button>
                </form>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="my-3">
    <h3 class="d-inline fw-bold">Turmas passadas</h3>
    <div class="d-flex py-3">
        <div class="card student-subjects box-shadow">
            <div class="card-body">
                <h3 class="card-title">2022.1</h3>
                <p class="card-text">cursando</p>
                <form class="text-end" action="">
                    <button class="btn btn-success" type="submit">ENTRAR</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
