@extends('manager.templates.panel')

@section('title', 'ACOMPANHAMENTO DE TCC')

@section('container')
@include('components.success')
@include('components.fail')
@include('components.auth-validation-errors')

<div class="container">
    <div class="row flex-column bg-gray-400 box-shadow">
        <div class="my-3">
            <h6>Orientador: <span class="fw-normal">{{$tcc->professor->name}}</span></h6>
        </div>
        <div class="my-3">
            <h6>Co-orientador:</h6>
        </div>
        <div class="my-3">
            <h6>Tema do TCC: <span class="fw-normal">{{$tcc->theme}}</span></h6>

        </div>
        <div class="my-3">
            <h6>Título do TCC: <span class="fw-normal">{{$tcc->title}}</span></h6>
        </div>
        <div class="my-3">
            <h6>Pré projeto defendido na disciplina pré-TCC: <span class="fw-normal">{{$tcc->file_tcc}}</span><h6>
        </div>
        <div class="my-3">
            <h6>Termo de Compromisso de Orientação Assinado: <span class="fw-normal">{{$tcc->term_commitment}}</span></h6>   
        </div>
        <div class="my-3 d-flex align-items-baseline gap-3 flex-wrap">
            <h6>Submetido ao comitê de ética: <span class="fw-normal">{{$tcc->ethics_committee ? 'sim': 'não'}}</span></h6>
        </div>
        <div class="my-3">
            <h6>Data pretendida: <span class="fw-normal">{{@datebr($tcc->date_claim)}}</span></h6>        
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