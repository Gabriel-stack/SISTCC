@extends('professor.templates.panel')

@section('title', 'ACOMPANHAMENTO DE ALUNO')

@section('container')

    @include('components.success')
    @include('components.fail')
    @include('components.auth-validation-errors')

    <div class="row p-2" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
        <div class="col-12 col-sm-6 col-md-4 mt-2">
            <span>Nome</span>
            <span class="form-control">{{ $student->name }}</span>
        </div>
        <div class="col-6 col-sm-4 col-md-2 mt-2">
            <span>Telefone</span>
            <span class="form-control">{{ $student->phone }}</span>
        </div>
        <div class="col-6 col-sm-4 col-md-2 mt-2">
            <span>Semestre de origem</span>
            <span class="form-control">{{ $student->semester_origin }}</span>
        </div>
        <div class="col-4 col-sm-4 col-md-2 mt-2">
            <span>Vezes que cursou tcc</span>
            <span class="form-control">{{ $student->attended_count_tcc }}</span>
        </div>
        <div class="col-8 col-sm-6 col-md-3 mt-2">
            <span>Disciplinas faltantes</span>
            <textarea class="form-control">{{ $student->attended_count_tcc }}</textarea>
        </div>
        <div class="col-4 col-sm-3 mt-2">
            <span>Orientador</span>
            <span class="form-control">{{ $student->name }}</span>
        </div>
        <div class="col-4 col-sm-3 mt-2">
            <span>Situação</span>
            <span class="form-control">{{ $student->name }}</span>
        </div>
        <div class="col-4 col-sm-3 mt-2">
            <span>Status</span>
            <span class="form-control">{{ $student->name }}</span>
        </div>
    </div>

    <div class="d-flex p-4 my-4 justify-content-between align-items-center"
        style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
        <div>
            <h5>ACOMPANHAMENTO DE TRABALHO DE CONCLUSÃO DE CURSO</h5>
        </div>
        <div>
            <a href="" style="font-size: 24px"><i class="bi bi-arrow-right-square"></i></a>
        </div>
    </div>
    <div class="d-flex p-4 my-4 justify-content-between align-items-center"
        style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
        <div>
            <h5>ACOMPANHAMENTO DE REQUERIMENTO DE DEFESA</h5>
        </div>
        <div>
            <a href="" style="font-size: 24px"><i class="bi bi-lock"></i></a>
        </div>
    </div>
    <div class="d-flex p-4 my-4 justify-content-between align-items-center"
        style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
        <div>
            <h5>ENVIO DE EMAIL PARA BIBLIOTECA</h5>
        </div>
        <div>
            <a href="" style="font-size: 24px"><i class="bi bi-lock"></i></a>
        </div>
    </div>
    <div class="d-flex p-4 my-4 justify-content-between align-items-center"
        style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
        <div>
            <h5>FINALIZAR DISCIPLINA</h5>
        </div>
        <div>
            <a href="" style="font-size: 24px"><i class="bi bi-lock"></i></a>
        </div>
    </div>
@endsection
