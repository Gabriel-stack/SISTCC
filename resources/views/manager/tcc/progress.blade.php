@extends('manager.templates.panel')

@section('title', 'Gestão de aluno')

@section('container')
    <div class="col-12">
        @include('components.fail')
    </div>

    <div class="d-flex flex-wrap bg-gray-400 box-shadow rounded-2 p-3">
        <div class="col-12 col-sm-6 col-md-3 mt-2 px-2">
            <span>Nome</span>
            <span class="form-control bg-gray text-dark">{{ $tcc->student->name }}</span>
        </div>
        <div class="col-6 col-sm-4 col-md-3 mt-2 px-2">
            <span>Telefone</span>
            <span class="form-control bg-gray text-dark">{{ $tcc->student->phone }}</span>
        </div>
        <div class="col-6 col-sm-4 col-md-3 mt-2 px-2">
            <span>Matrícula</span>
            <span class="form-control bg-gray text-dark">{{ $tcc->student->registration }}</span>
        </div>
        <div class="col-4 col-sm-2 mt-2 px-2 d-flex flex-column align-items-center">
            <span>Histórico do aluno</span>
            <a class="form-control w-auto btn btn-warning text-white" target="_blank" href="{{route('file', substr($tcc->student->historic, 10))}}">
                BAIXAR
            </a>
        </div>
        <div class="col-4 col-sm-3 mt-2 px-2">
            <span>Orientador</span>
            <span class="form-control bg-gray text-dark">{{ $tcc->professor->name ?? '-' }}</span>
        </div>
        @if (true)
            <div class="col-4 col-sm-3 mt-2 px-2">
                <span>Co-orientador</span>
                <span class="form-control bg-gray text-dark">{{ $coprofessor->name ?? '-' }}</span>
            </div>
        @endif
        <div class="col-4 col-sm-3 mt-2 px-2">
            <span>Etapa</span>
            <span class="form-control bg-gray text-dark">{{ $tcc->stage }}</span>
        </div>
        <div class="col-4 col-sm-3 mt-2 px-2">
            <span>Situação</span>
            <span class="form-control bg-gray text-dark">{{ $tcc->situation }}</span>
        </div>
        @if (!in_array($tcc->situation, ['Reprovado', 'Concluído']))
            <div class="col-5 col-md-2 mt-2 px-2">
                <button type="button" class="btn btn-danger text-white my-3" data-bs-toggle="modal"
                    data-bs-target="#modal-disapprove-tcc" data-tcc="{{ $tcc }}">
                    REPROVAR
                </button>
                @include('manager.components.tcc.modal_disapprove_tcc')
            </div>
        @endif
        @if ($tcc->stage == 'Etapa 3')
            <div class="col-5 col-md-3 mt-2 px-2 d-flex gap-2">
                <a type="button" class="btn btn-primary text-white my-3" target="_blank"
                    href="{{ route('manager.ata', $tcc) }}">
                    GERAR ATA
                </a>
                <a type="button" class="btn btn-primary text-white my-3" target="_blank"
                    href="{{ route('manager.barema', $tcc) }}">
                    GERAR BAREMA
                </a>
            </div>
        @endif
    </div>

    <div class="d-flex flex-wrap justify-content-between align-items-center bg-gray-400 box-shadow rounded-2 p-4 mt-3">
        <div class="col">
            <span class="text-muted">ETAPA 1</span>
            <h5 class="me-2">ACOMPANHAMENTO DE TCC</h5>
        </div>
        <div class="col d-flex justify-content-end">
            @if (($tcc->stage == 'Etapa 1' && in_array($tcc->situation, ['Em análise', 'Devolvido', 'Reprovado']) && $tcc->file_pretcc) || $tcc->stage != 'Etapa 1')
                <a href="{{ route('manager.accompaniment.tcc', $tcc) }}" style="font-size: 24px">
                    <i class="bi bi-arrow-right-square"></i>
                </a>
            @else
                <i class="bi bi-lock" style="font-size: 24px"></i>
            @endif
        </div>
    </div>
    <div class="d-flex flex-wrap justify-content-between align-items-center bg-gray-400 box-shadow rounded-2 p-4 mt-3">
        <div class="col">
            <span class="text-muted">ETAPA 2</span>
            <h5 class="me-2">ACOMPANHAMENTO DE REQUERIMENTO DE DEFESA</h5>
        </div>
        <div class="col d-flex justify-content-end">
            @if (($tcc->stage == 'Etapa 2' && in_array($tcc->situation, ['Em análise', 'Devolvido', 'Reprovado']) && $tcc->file_tcc) || !in_array($tcc->stage, ['Etapa 1', 'Etapa 2']))
                <a href="{{ route('manager.accompaniment.requirement', $tcc) }}" style="font-size: 24px">
                    <i class="bi bi-arrow-right-square"></i>
                </a>
            @else
                <i class="bi bi-lock" style="font-size: 24px"></i>
            @endif
        </div>
    </div>
    <div class="d-flex flex-wrap justify-content-between align-items-center bg-gray-400 box-shadow rounded-2 p-4 mt-3">
        <div class="col">
            <span class="text-muted">ETAPA 3</span>
            <h5 class="me-2">ENTREGA DE TCC</h5>
        </div>
        <div class="col d-flex justify-content-end">
            @if ($tcc->stage == 'Etapa 3' && $tcc->situation != 'Cursando' && $tcc->final_tcc)
                <a href="{{ route('manager.accompaniment.finish', $tcc) }}" style="font-size: 24px">
                    <i class="bi bi-arrow-right-square"></i>
                </a>
            @else
                <i class="bi bi-lock" style="font-size: 24px"></i>
            @endif
        </div>
    </div>
    <div class="my-3">
        <a class="btn btn-secondary text-white"
            href="{{ route('manager.subject', [$tcc->subject_id]) }}">VOLTAR</a>
    </div>
@endsection
