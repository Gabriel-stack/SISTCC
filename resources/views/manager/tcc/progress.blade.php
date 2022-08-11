@extends('manager.templates.panel')

@section('title', 'Gestão de aluno')

@section('container')
<div class="col-12">
    @include('components.fail')
</div>

<div class="d-flex flex-wrap bg-gray-400 box-shadow rounded-2 p-3">
    <div class="col-12 d-flex flex-wrap justify-content-between align-items-center px-2">
        <h5 class="my-2 me-2">Dados do aluno</h5>
        @if (!in_array($tcc->situation, ['Reprovado', 'Concluído']))
            <button type="button" class="btn btn-danger text-white my-2" data-bs-toggle="modal"
                data-bs-target="#modal-disapprove-tcc" data-tcc="{{ $tcc }}">
                REPROVAR
            </button>
            @include('manager.components.tcc.modal_disapprove_tcc')
        @elseif ($tcc->subject->is_active == true && $tcc->situation == 'Reprovado')
            <button type="button" class="btn btn-danger text-white my-2" data-bs-toggle="modal"
                data-bs-target="#modal-cancel-disapproval-tcc" data-tcc="{{ $tcc }}">
                CANCELAR REPROVAÇÃO
            </button>
            @include('manager.components.tcc.modal_cancel_disapproval_tcc')
        @endif
    </div>
    <div class="col-12 col-sm-12 col-md-8 col-lg-6 mt-2 px-2">
        <label>Nome</label>
        <span class="form-control bg-gray text-dark">{{ $tcc->student->name }}</span>
    </div>
    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-2 px-2">
        <label>Matrícula</label>
        <span class="form-control bg-gray text-dark">{{ $tcc->student->registration }}</span>
    </div>
    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-2 px-2">
        <label>Telefone</label>
        <span class="form-control bg-gray text-dark">{{ $tcc->student->phone }}</span>
    </div>

    <div class="col-12 col-sm-12 col-md-8 col-lg-6 mt-2 px-2">
        <label>Orientador</label>
        <span class="form-control bg-gray text-dark">{{ $tcc->professor->name ?? '-' }}</span>
    </div>

    <div class="col-12 col-sm-12 col-md-8 col-lg-6 mt-2 px-2">
        <label>Co-orientador</label>
        <span class="form-control bg-gray text-dark">{{ $coprofessor->name ?? '-' }}</span>
    </div>

    <div class="col-12 col-sm-4 col-lg-2 mt-2 px-2">
        <label>Etapa</label>
        <span class="form-control bg-gray fw-bold text-dark">{{ $tcc->stage }}</span>
    </div>
    <div class="col-12 col-sm-4 col-lg-2 mt-2 px-2">
        <label>Situação</label>
        <span class="form-control bg-gray fw-bold
                @switch ($tcc->situation)
                @case('Reprovado') text-danger @break
                @case('Devolvido') text-danger @break
                @case('Concluído') text-success @break
                @case('Cursando') text-warning @break
                @case('Em análise') text-info @break @endswitch">
            {{ $tcc->situation }}</span>
    </div>
    <div class="col-6 col-sm-4 col-lg-2 mt-2 px-2">
        <label class="w-100">Histórico</label>
        <a class="form-control btn btn-warning text-white w-100" target="_blank"
            href="{{route('file', substr($tcc->student->historic, 9))}}">
            BAIXAR
        </a>
    </div>
    @if ($tcc->stage == 'Etapa 3')
    <div class="col-6 col-sm-4 col-lg-2 mt-2 px-2">
        <label class="w-100">Ata</label>
        <a type="button" class="btn btn-primary text-white w-100" target="_blank" href="{{ route('manager.ata', $tcc) }}">
            GERAR
        </a>
    </div>
    <div class="col-6 col-sm-4 col-lg-2 mt-2 px-2">
        <label class="w-100">Barema</label>
        <a type="button" class="btn btn-primary text-white w-100" target="_blank" href="{{ route('manager.barema', $tcc) }}">
            GERAR
        </a>
    </div>
    <div class="col-6 col-sm-4 col-lg-2 mt-2 px-2">
        <label class="w-100">Declarações</label>
        <a type="button" class="btn btn-primary text-white w-100" target="_blank"
            href="{{ route('manager.declaracao', $tcc) }}">
            GERAR
        </a>
    </div>
    @endif
</div>

<div class="d-flex justify-content-between align-items-center bg-gray-400 box-shadow rounded-2 p-4 mt-3">
    <div>
        <span class="text-muted">ETAPA 1</span>
        <h5 class="me-2">ACOMPANHAMENTO DE TCC</h5>
    </div>
    <div class="d-flex justify-content-end">
        @if (($tcc->stage == 'Etapa 1' && in_array($tcc->situation, ['Em análise', 'Devolvido', 'Reprovado']) &&
        $tcc->file_pretcc) || $tcc->stage != 'Etapa 1')
        <a href="{{ route('manager.accompaniment.tcc', $tcc) }}" style="font-size: 24px">
            <i class="bi bi-arrow-right-square"></i>
        </a>
        @else
        <i class="bi bi-lock" style="font-size: 24px"></i>
        @endif
    </div>
</div>
<div class="d-flex justify-content-between align-items-center bg-gray-400 box-shadow rounded-2 p-4 mt-3">
    <div>
        <span class="text-muted">ETAPA 2</span>
        <h5 class="me-2">ACOMPANHAMENTO DE REQUERIMENTO DE DEFESA</h5>
    </div>
    <div class="d-flex justify-content-end">
        @if (($tcc->stage == 'Etapa 2' && in_array($tcc->situation, ['Em análise', 'Devolvido', 'Reprovado']) &&
        $tcc->file_tcc) || !in_array($tcc->stage, ['Etapa 1', 'Etapa 2']))
        <a href="{{ route('manager.accompaniment.requirement', $tcc) }}" style="font-size: 24px">
            <i class="bi bi-arrow-right-square"></i>
        </a>
        @else
        <i class="bi bi-lock" style="font-size: 24px"></i>
        @endif
    </div>
</div>
<div class="d-flex justify-content-between align-items-center bg-gray-400 box-shadow rounded-2 p-4 mt-3">
    <div>
        <span class="text-muted">ETAPA 3</span>
        <h5 class="me-2">ENTREGA DE TCC</h5>
    </div>
    <div class="d-flex justify-content-end">
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
    <a class="btn btn-secondary text-white" href="{{ route('manager.subject', [$tcc->subject_id]) }}">VOLTAR</a>
</div>
@endsection
