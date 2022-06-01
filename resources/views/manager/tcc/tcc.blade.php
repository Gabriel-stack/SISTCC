@extends('manager.templates.panel')

@section('title', 'ACOMPANHAMENTO DE TCC')

@section('container')
    @include('components.success')
    @include('components.fail')
    @include('components.auth-validation-errors')

    <div class="container">
        <div class="row flex-column bg-gray-400 box-shadow">
            <div class="my-3 d-flex gap-3 flex-wrap">
                <h6>Orientador:</h6>
                <span>{{$tcc->professor->name}}</span>
            </div>
            <div class="my-3 d-flex gap-3 flex-wrap">
                <h6>Co-orientador:</h6>
            </div>
            <div class="my-3 d-flex gap-3 flex-wrap">
                <h6>Tema do TCC :</h6>
                <span>{{$tcc->theme}}</span>
            </div>
            <div class="my-3 d-flex gap-3 flex-wrap">
                <h6>Título do TCC :</h6>
                <span>{{$tcc->title}}</span>
            </div>
            <div class="my-3 d-flex gap-3 flex-wrap">
                <h6>Pré projeto defendido na disciplina pré-TCC<h6>
                        <span>{{$tcc->file_tcc}}</span>
            </div>
            <div class="my-3 d-flex gap-3 flex-wrap">
                <h6>Termo de Compromisso de Orientação Assinado :</h6>
                <span>{{$tcc->term_commitment}}</span>
            </div>
            <div class="my-3 d-flex gap-3 flex-wrap">
                <h6>Submetido ao comitê de ética :</h6>
                <span>{{$tcc->ethics_committee}}</span>
            </div>
            <div class="my-3 d-flex gap-3 flex-wrap">
                <h6>Data pretendida :</h6>
                <span>{{@datebr($tcc->date_claim)}}</span>
            </div>
        </div>
        <div class="my-3 d-flex gap-2">
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
    </div>
@endsection
