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

        @if($inside)
        <div class="card student-subjects box-shadow">
            <div class="card-body">
                <h3 class="card-title">{{$active_class->class}}</h3>
                <p class="card-text w-auto text-warning">cursando</p>
                <a class="text-end btn btn-success" href="{{route('student.progress', $active_class)}}">ENTRAR</a>
            </div>
        </div>
        @else
        <div class="card student-subjects box-shadow">
            <div class="card-body">
                <h3 class="card-title">{{$active_class->class}}</h3>
                <p class="card-text"></p>
                <button class="btn btn-success" type="submit">MATRICULAR</button>
            </div>
        </div>
        @endif
    </div>
</div>
<hr>
<div class="my-3">
    <h3 class="d-inline fw-bold">Turmas passadas</h3>
    <div class="d-flex py-3">
        @forelse($classes as $class)

        <div class="card student-subjects-end box-shadow">
            <div class="card-body">
                <h3 class="card-title">{{$class->class}}</h3>
                <p class="card-text">{{$class->class_code}}</p>
                <a class="text-end btn btn-success" href="{{route('student.progress', $class)}}">ENTRAR</a>
            </div>
        </div>
        @empty
        <h5 class="text-center" colspan="6">NÃO HÁ HISTÓRICO DE TURMAS!</h5>
        @endforelse
    </div>
</div>
@endsection