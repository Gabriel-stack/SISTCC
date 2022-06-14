@extends('manager.templates.panel')

@section('title', 'Acompanhamento de TCC')

@section('container')
    <div class="col-12">
        @include('components.success')
        @include('components.fail')
        @include('components.auth-validation-errors')
    </div>

    <div class="d-flex flex-wrap bg-gray-400 box-shadow rounded-2 px-4 py-3">
        <div class="col-12 col-md-6">
            <div class="mt-3 px-2">
                <label class="w-100">Orientador</label>
                <span class="fw-normal form-control bg-gray">{{ $tcc->professor->name ?? '-' }}</span>
            </div>
            <div class="mt-3 px-2">
                <label class="w-100">Co-orientador</label>
                <span class="fw-normal form-control bg-gray">{{ $coprofessor->name ?? '-' }}</span>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="mt-3 px-2">
                <label class="form-label w-100">Tema do TCC</label>
                <span class="fw-normal form-control bg-gray">{{ $tcc->theme }}</span>
            </div>
            <div class="mt-3 px-2">
                <label class="form-label w-100">Título do TCC</label>
                <span class="fw-normal form-control bg-gray">{{ $tcc->title }}</span>
            </div>
        </div>
        <div class="col-12 d-flex flex-wrap align-items-end">
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 my-3 px-2">
                <label class="form-label w-100">Pré projeto defendido na disciplina pré-TCC</label>
                <a class="btn btn-warning text-white" target="_blank" href="{{ route('file', substr($tcc->file_pretcc, 4)) }}">VISUALIZAR</a>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 my-3 px-2">
                <label class="form-label w-100">Termo de Compromisso de Orientação</label>
                <a class="btn btn-warning text-white" target="_blank" href="{{ route('file', substr($tcc->term_commitment, 4)) }}">VISUALIZAR</a>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-2 d-flex flex-column my-3 px-2">
                <label class="w-100">Submetido ao comitê de ética</label>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-secondary">
                        <input class="form-check-input" name="ethics_committee" type="radio"
                            @if ($tcc->ethics_committee) checked @endif disabled> sim
                    </label>
                    <label class="btn btn-secondary">
                        <input class="form-check-input" name="ethics_committee" type="radio"
                            @if (!$tcc->ethics_committee) checked @endif disabled> não
                    </label>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-2 my-3 px-2">
                <label class="w-100">Data pretendida</label>
                <span class="fw-normal form-control bg-gray">{{ @datebr($tcc->date_claim) }}</span>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between">
        <div>
            <a class="btn btn-secondary text-white my-3" href="{{ route('manager.show', [$tcc->subject_id, $tcc->id]) }}">VOLTAR</a>
        </div>
        @if ($tcc->stage == 'Etapa 1' && $tcc->situation == 'Em análise')
            <div class="d-flex flex-wrap justify-content-end">
                <button type="button" class="btn btn-warning text-white my-3" data-bs-toggle="modal"
                    data-bs-target="#modal-return-tcc" data-tcc="{{ $tcc }}">
                    DEVOLVER
                </button>
                @include('manager.components.tcc.modal_return_tcc')
                <button type="button" class="btn btn-success text-white my-3 ms-2" data-bs-toggle="modal"
                    data-bs-target="#modal-validate-tcc" data-tcc="{{ $tcc }}">
                    VALIDAR
                </button>
                @include('manager.components.tcc.modal_validate_tcc')
            </div>
        @endif
    </div>
@endsection
