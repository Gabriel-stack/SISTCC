@extends('manager.templates.panel')

@section('title', 'ACOMPANHAMENTO DE ALUNO')

@section('container')
    @include('components.success')
    @include('components.fail')
    @include('components.auth-validation-errors')

    <div class="row p-3 bg-white box-shadow">
        <div class="col-12 col-sm-6 col-md-3 mt-2">
            <span>Nome</span>
            <span class="form-control bg-gray text-dark">{{ $tcc->student->name }}</span>
        </div>
        <div class="col-6 col-sm-4 col-md-3 mt-2">
            <span>Telefone</span>
            <span class="form-control bg-gray text-dark">{{ $tcc->student->phone }}</span>
        </div>
        <div class="col-6 col-sm-4 col-md-2 mt-2">
            <span>Semestre de origem</span>
            <span class="form-control bg-gray text-dark">{{ $tcc->student->semester_origin }}</span>
        </div>
        <div class="col-4 col-sm-4 col-md-2 mt-2">
            <span>Vezes que cursou tcc</span>
            <span class="form-control bg-gray text-dark">{{ $tcc->student->attended_count_tcc }}</span>
        </div>
        <div class="col-4 col-sm-2 mt-2 d-flex flex-column align-items-center">
            <span>Histórico do aluno</span>
            <a class="form-control w-auto btn btn-warning" href="#">
                BAIXAR
            </a>
        </div>
        <div class="col-4 col-sm-3 mt-2">
            <span>Orientador</span>
            <span class="form-control bg-gray text-dark">{{ $tcc->professor->name ?? '-' }}</span>
        </div>
        @if (true)
            <div class="col-4 col-sm-3 mt-2">
                <span>Co-orientador</span>
                {{-- <span class="form-control bg-gray text-dark">{{ $tcc->professor->name }}</span> --}}
            </div>
        @endif
        <div class="col-4 col-sm-3 mt-2">
            <span>Etapa</span>
            <span class="form-control bg-gray text-dark">{{ $tcc->stage }}</span>
        </div>
        <div class="col-4 col-sm-3 mt-2">
            <span>Situação</span>
            <span class="form-control bg-gray text-dark">{{ $tcc->situation }}</span>
        </div>
        <div class="col-4 col-sm-1 mt-2 d-flex flex-column align-items-start">
            <button class="form-control w-auto btn btn-danger" type="button">REPROVAR</button>
        </div>
    </div>

    <div class="row p-4 my-4 justify-content-between align-items-center bg-white" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
        <div class="col">
            <h6 class="title">ACOMPANHAMENTO DE TRABALHO DE CONCLUSÃO DE CURSO</h6>
        </div>
        <div class="col d-flex justify-content-end">
            @if (in_array($tcc->stage,['Etapa 1', 'Etapa 2', 'Etapa 3']))
                <a href="{{ route('manager.accompaniment.tcc', $tcc) }}" style="font-size: 24px"><i class="bi bi-arrow-right-square"></i></a>
            @else
                <i class="bi bi-lock" style="font-size: 24px"></i>
            @endif
        </div>
    </div>
    <div class="row p-4 my-4 justify-content-between align-items-center bg-white" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
        <div class="col">
            <h6 class="title">ACOMPANHAMENTO DE REQUERIMENTO DE DEFESA</h6>
        </div>
        <div class="col d-flex justify-content-end">
            @if (in_array($tcc->stage,['Etapa 2', 'Etapa 3']))
                <a href="{{ route('manager.accompaniment.requirement', $tcc) }}" style="font-size: 24px"><i class="bi bi-arrow-right-square"></i></a>
            @else
                <i class="bi bi-lock" style="font-size: 24px"></i>
            @endif
        </div>
    </div>
    <div class="row p-4 my-4 justify-content-between align-items-center bg-white" style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
        <div class="col">
            <h6 class="title">FINALIZAR DISCIPLINA</h6>
        </div>
        <div class="col d-flex justify-content-end">
            @if ($tcc->stage == 'Etapa 3')
                <a href="{{ route('manager.accompaniment.finish', $tcc) }}" style="font-size: 24px"><i class="bi bi-arrow-right-square"></i></a>
            @else
                <i class="bi bi-lock" style="font-size: 24px"></i>
            @endif
        </div>
    </div>
@endsection
