@extends('student.templates.panel')

@section('title', $tcc->subject->class)

@section('container')
    <div class="col-12">
        @if ($tcc->situation == 'Devolvido')
            <div class="alert alert-danger text-center">
                <h5 class="fw-bold">Algo está errado! {{ $tcc->stage }} foi devolvida.</h5>
            </div>
        @endif

        @if ($tcc->situation == 'Cursando')
            <div class="alert alert-success text-center">
                <h5 class="fw-bold">{{ $tcc->stage }} está liberada!</h5>
            </div>
        @endif

        @if ($tcc->situation == 'Em análise')
            <div class="alert alert-success text-center">
                <h5 class="fw-bold">{{ $tcc->stage }} está sendo analisada pelo professor!</h5>
            </div>
        @endif

        @include('components.success')
        @include('components.fail')
        @include('components.auth-validation-errors')
    </div>

    <div class="d-flex justify-content-between align-items-center bg-gray-400 box-shadow rounded-2 p-4">
        <div>
            <span class="text-muted">ETAPA 1</span>
            <h5 class="me-2">CADASTRAR DE TCC</h5>
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
    <div class="d-flex justify-content-between align-items-center bg-gray-400 box-shadow rounded-2 p-4 mt-4">
        <div>
            <span class="text-muted">ETAPA 2</span>
            <h5 class="me-2">CADASTRAR REQUERIMENTO DE DEFESA</h5>
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
    <div class="d-flex justify-content-between align-items-center bg-gray-400 box-shadow rounded-2 p-4 mt-4">
        <div>
            <span class="text-muted">ETAPA 3</span>
            <h5 class="me-2">ENTREGAR DE TCC</h5>
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
