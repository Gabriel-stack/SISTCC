@extends('student.templates.panel')

@section('title', 'Acompanhamento de TCC')

@section('container')
    <div class="d-flex flex-column bg-gray-400 box-shadow rounded-2 p-4">
        <div class="my-3">
            <h6>Orientador: <span class="fw-normal">{{ $tcc->professor->name ?? '-' }}</span></h6>
        </div>
        <div class="my-3">
            <h6>Co-orientador: <span class="fw-normal">{{ $coprofessor->name ?? '-' }}</span></h6>
        </div>
        <div class="my-3">
            <h6>Tema do TCC: <span class="fw-normal">{{ $tcc->theme }}</span></h6>

        </div>
        <div class="my-3">
            <h6>Título do TCC: <span class="fw-normal">{{ $tcc->title }}</span></h6>
        </div>
        <div class="my-3">
            <h6>Pré projeto defendido na disciplina pré-TCC:
                <a target="_blank" href="{{ $tcc->file_tcc }}"><i class="bi bi-archive"></i></a>
            <h6>
        </div>
        <div class="my-3">
            <h6>Termo de Compromisso de Orientação Assinado:
                <a target="blank" href="{{ $tcc->term_commitment }}"><i class="bi bi-archive"></i></a>
            </h6>
        </div>
        <div class="my-3 d-flex align-items-baseline gap-3 flex-wrap">
            <h6>Submetido ao comitê de ética:
                <span class="fw-normal">{{ $tcc->ethics_committee ? 'sim' : 'não' }}</span>
            </h6>
        </div>
        <div class="my-3">
            <h6>Data pretendida: <span class="fw-normal">{{ @datebr($tcc->date_claim) }}</span></h6>
        </div>
    </div>
    <div>
        <a class="btn btn-secondary text-white my-3" href="{{ route('student.progress', [$tcc->subject_id]) }}">VOLTAR</a>
    </div>
@endsection
