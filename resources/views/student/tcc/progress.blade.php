@extends('student.templates.panel')

@section('title', 'TCC | 2022.1')

@section('container')

    @include('components.success')
    @include('components.fail')
    @include('components.auth-validation-errors')


    @if ($tcc->situation == 'Devolvido')
        <div class="alert alert-danger text-center">
            <h5 class="title fw-bold">A etapa foi devolvida!</h5>
            <p>{{ $tcc->message }}</p>
        </div>
    @endif

    <div class="d-flex p-4 my-4 justify-content-between align-items-center bg-white"
        style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
        <div>
            <h5>CADASTRAR TRABALHO DE CONCLUSÃO DE CURSO</h5>
        </div>
        <div>
            @if (($tcc->stage == 'Etapa 1' && in_array($tcc->situation, ['Cursando', 'Devolvido'])))
                <a href="{{ route('student.progress.tcc', $tcc->subject_id) }}" style="font-size: 24px">
                    <i class="bi bi-arrow-right-square"></i>
                </a>
            @elseif ($tcc->stage != 'Etapa 1' || !in_array($tcc->situation, ['Cursando', 'Devolvido']))
                <a href="{{ route('student.accompaniment.tcc', $tcc->id) }}" style="font-size: 24px">
                    <i class="bi bi-eye"></i>
                </a>
            @else
                <i class="bi bi-lock" style="font-size: 24px"></i>
            @endif
        </div>
    </div>
    <div class="d-flex p-4 my-4 justify-content-between align-items-center bg-white"
        style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
        <div>
            <h5>CADASTRAR REQUERIMENTO DE DEFESA</h5>
        </div>
        <div>
            @if ($tcc->stage == 'Etapa 2' && in_array($tcc->situation, ['Cursando', 'Devolvido']))
                <a href="{{ route('student.progress.requirement', $tcc->subject_id) }}" style="font-size: 24px">
                    <i class="bi bi-arrow-right-square"></i>
                </a>
            @elseif (($tcc->stage == 'Etapa 2' && !in_array($tcc->situation, ['Cursando', 'Devolvido'])) || !in_array($tcc->stage, ['Etapa 1', 'Etapa 2']))
                <a href="{{ route('student.accompaniment.requirement', $tcc->id) }}" style="font-size: 24px">
                    <i class="bi bi-eye"></i>
                </a>
            @else
                <i class="bi bi-lock" style="font-size: 24px"></i>
            @endif
        </div>
    </div>
    <div class="d-flex p-4 my-4 justify-content-between align-items-center bg-white"
        style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
        <div>
            <h5>ENTREGA DE TCC</h5>
        </div>
        <div>
            @if ($tcc->stage == 'Etapa 3' && in_array($tcc->situation, ['Cursando', 'Devolvido']))
                <a href="{{ route('student.progress.finish', $tcc->subject_id) }}" style="font-size: 24px">
                    <i class="bi bi-arrow-right-square"></i>
                </a>
            @elseif ($tcc->stage == 'Etapa 3' && !in_array($tcc->situation, ['Cursando', 'Devolvido']) || !in_array($tcc->stage, ['Etapa 1', 'Etapa 2', 'Etapa 3']))
                <a href="{{ route('student.accompaniment.finish', $tcc->id) }}" style="font-size: 24px">
                    <i class="bi bi-eye"></i>
                </a>
            @else
                <i class="bi bi-lock" style="font-size: 24px"></i>
            @endif
        </div>
    </div>
    <div class="my-3 text-start">
        <a class="btn btn-secondary" href="{{ route('student.dashboard') }}">VOLTAR</a>
    </div>
@endsection
