@extends('student.templates.panel')

@section('title', 'TCC | 2022.1')

@section('container')

@include('components.success')
@include('components.fail')
@include('components.auth-validation-errors')
<div class="d-flex p-4 my-4 justify-content-between align-items-center bg-white"
    style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
    <div>
        <h5>CADASTRAR TRABALHO DE CONCLUSÃO DE CURSO</h5>
    </div>
    <div>
        <a href="{{ route('student.progress.tcc', $tcc->subject_id) }}" style="font-size: 24px"><i
                class="bi bi-arrow-right-square"></i></a>
    </div>
</div>
<div class="d-flex p-4 my-4 justify-content-between align-items-center bg-white"
    style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
    <div>
        <h5>CADASTRAR REQUERIMENTO DE DEFESA</h5>
    </div>
    <div>
        @if($tcc->stage == "Etapa 2")
        <a href="{{ route('student.progress.requirement', $tcc->subject_id) }}" style="font-size: 24px"><i
                class="bi bi-arrow-right-square"></i></a>
        @else
        <i class="bi bi-lock"></i>
        @endif
    </div>
</div>
<div class="d-flex p-4 my-4 justify-content-between align-items-center bg-white"
    style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
    <div>
        <h5>FINALIZAR DISCIPLINA</h5>
    </div>
    <div>
        @if($tcc->stage == "Etapa 3")
        <a href="{{ route('student.progress.finish', $tcc->subject_id) }}" style="font-size: 24px"><i
                class="bi bi-arrow-right-square"></i></a>
        @else
        <i class="bi bi-lock"></i>
        @endif
    </div>
</div>
@endsection