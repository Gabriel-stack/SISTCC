@extends('manager.templates.panel')

@section('title', 'ACOMPANHAMENTO DE TCC')

@section('container')
    @include('components.success')
    @include('components.fail')
    @include('components.auth-validation-errors')

    <div class="container">
        <div class="row flex-column bg-gray-400 box-shadow">
            <div class="my-3">
                <h6>Orientador:
                    <span class="fw-normal">{{ $tcc->professor->name ?? '-' }}</span>
                </h6>
            </div>
            <div class="my-3">
                <h6>Co-orientador:
                    <span class="fw-normal">{{ $coprofessor->name ?? '-' }}</span>
                </h6>
            </div>
            <div class="my-3">
                <h6>Tema do TCC:
                    <span class="fw-normal">{{ $tcc->theme }}</span>
                </h6>
            </div>
            <div class="my-3">
                <h6>Título do TCC:
                    <span class="fw-normal">{{ $tcc->title }}</span>
                </h6>
            </div>
            <div class="my-3">
                <h6>Pré projeto defendido na disciplina pré-TCC:
                    {{-- <a href="{{ route('file', $tcc->file_pretcc) }}"><i class="bi bi-archive"></i></a> --}}
                    <form action="{{ route('file') }}" method="POST">
                        @csrf
                        <input class="d-none" type="hidden" name="file" value="{{ $tcc->file_pretcc }}">
                        <button type="submit" name="submit"><i class="bi bi-archive"></i></button>
                    </form>
                <h6>
            </div>
            <div class="my-3">
                <h6>Termo de Compromisso de Orientação Assinado:
                    <a href="{{ asset($tcc->term_commitment) }}"><i class="bi bi-archive"></i></a>
                </h6>
            </div>
            <div class="my-3 d-flex align-items-baseline gap-3 flex-wrap">
                <h6>Submetido ao comitê de ética:
                    <span class="fw-normal">{{ $tcc->ethics_committee ? 'sim' : 'não' }}</span>
                </h6>
            </div>
            <div class="my-3">
                <h6>Data pretendida:
                    <span class="fw-normal">{{ @datebr($tcc->date_claim) }}</span>
                </h6>
            </div>
        </div>
        <div class="my-3 d-flex justify-content-between gap-2">
            <div>
                <a class="btn btn-secondary text-white my-3" href="{{ route('manager.show', [$tcc->subject_id, $tcc->id]) }}">VOLTAR</a>
            </div>
            @if ($tcc->stage == 'Etapa 1' && $tcc->situation == 'Em análise')
                <div>
                    <button type="button" class="btn btn-warning text-white my-3" data-bs-toggle="modal"
                        data-bs-target="#modal-return-tcc" data-tcc="{{ $tcc }}">
                        DEVOLVER
                    </button>
                    @include('manager.components.tcc.modal_return_tcc')
                    <button type="button" class="btn btn-success text-white my-3" data-bs-toggle="modal"
                        data-bs-target="#modal-validate-tcc" data-tcc="{{ $tcc }}">
                        VALIDAR
                    </button>
                    @include('manager.components.tcc.modal_validate_tcc')
                </div>
            @endif
        </div>
    </div>
@endsection
