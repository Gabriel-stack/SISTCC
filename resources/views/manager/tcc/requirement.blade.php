@extends('manager.templates.panel')

@section('title', 'Requerimento de defesa')

@section('container')
    <div class="col-12">
        @include('components.fail')
    </div>

    <div class="d-flex flex-wrap align-items-baseline bg-gray-400 box-shadow rounded-2 p-3 mb-3">
        <div class="col-12 col-md-6 col-lg-3">
            <div class="my-2 px-2 d-flex flex-column">
                <label class="form-label w-100">Foto 3x4</label>
                <img src="{{ asset("storage" . substr($tcc->photo, 6)) }}" alt="" width="113px" height="151px">
            </div>
            <div class="my-2 px-2">
                <label class="form-label w-100">Data de defesa</label>
                <span class="fw-normal form-control bg-gray">{{ @datebr($tcc->intended_date) }}</span>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="my-2 px-2">
                <label class="form-label w-100">Tipo de TCC</label>
                <span class="fw-normal form-control bg-gray">{{ $tcc->type_tcc }}</span>
            </div>
            <div class="my-2 px-2">
                <label class="form-label w-100">Palavras-chave</label>
                <span class="fw-normal form-control bg-gray">{{ $tcc->keywords }}</span>
            </div>
        </div>
        <div class="col-12 col-lg-6 d-flex flex-column px-2">
            <label class="form-label w-100">Resumo</label>
            <textarea class="p-2" cols="30" rows="4" disabled>{{ $tcc->abstract }}</textarea>
        </div>
    </div>
    <div
        class="d-flex flex-wrap justify-content-center align-items-center bg-gray-400 box-shadow rounded-2 p-3 my-3 px-2">
        <div class="col-12 col-sm-6 col-lg-3 p-2">
            <label class="form-label w-100">TCC finalizado</label>
            <a class="btn btn-warning text-white" target="_blank" href="{{ route('file', substr($tcc->file_tcc, 4)) }}">
                VISUALIZAR
            </a>
        </div>
        @if ($tcc->ethics_committee)
            <div class="col-12 col-sm-6 col-lg-3 my-2 p-2">
                <label class="form-label w-100">Parecer do comitê de ética</label>
                <a class="btn btn-warning text-white" target="_blank" href="{{ route('file', substr($tcc->result_ethic_commitee, 4)) }}">
                    VISUALIZAR
                </a>
            </div>
        @endif
        <div class="col-12 col-sm-6 col-lg-3 my-2 p-2" id="proof_article"
            style="@if (!$tcc->proof_article_submission) display: none; @endif">
            <label for="proof_article_submission" class="form-label w-100">Comprovante de submissão do artigo</label>
            <a class="btn btn-warning text-white" target="_blank" href="{{ route('file', substr($tcc->proof_article_submission, 4)) }}">
                VISUALIZAR
            </a>
        </div>
    </div>
    <div class="d-flex flex-wrap align-items-baseline bg-gray-400 box-shadow rounded-2 p-3 my-3 px-2">
        <div class="col-12">
            <h5 class="fs-5 fw-bold px-2">Orientador</h5>
        </div>
        <hr>
        <div class="col-12 col-sm-12 col-md-6 my-2 px-2">
            <label class="form-label w-100">Nome</label>
            <span class="fw-normal form-control bg-gray">{{ $tcc->professor->name }}</span>
        </div>
        <div class="col-12 col-sm-12 col-md-6 my-2 px-2">
            <label class="form-label w-100">Orgão</label>
            <span class="fw-normal form-control bg-gray">{{ $tcc->professor->organ }}</span>
        </div>
        <div class="col-12 col-sm-12 col-md-6 my-2 px-2">
            <label class="form-label w-100">Titulação</label>
            <span class="fw-normal form-control bg-gray">{{ $tcc->professor->titration }}</span>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-3 my-2 px-2">
            <label class="form-label w-100">CPF</label>
            <span class="fw-normal form-control bg-gray">{{ $tcc->professor->cpf }}</span>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-2 px-2">
            <label class="form-label w-100">Termo de anuência</label>
            <a class="btn btn-warning text-white" target="_blank" href="{{ route('file', substr($tcc->consent_professor, 4)) }}">
                VISUALIZAR
            </a>
        </div>
    </div>
    @foreach ($members as $key => $member)
        <div class="d-flex flex-wrap align-items-baseline bg-gray-400 box-shadow rounded-2 p-3 mt-3 px-2">
            <div class="col-12">
                <h5 class="fs-5 fw-bold px-2">Membro @if($key == 'one') 1 @elseif($key == 'two') 2 @elseif($key == 'three') 3 @endif</h5>
            </div>
            <hr>
            <div class="col-12 col-sm-12 col-md-6 my-2 px-2">
                <label class="form-label w-100">Nome</label>
                <span class="fw-normal form-control bg-gray">{{ $member->name }}</span>
            </div>
            <div class="col-12 col-sm-12 col-md-6 my-2 px-2">
                <label class="form-label w-100">Orgão</label>
                <span class="fw-normal form-control bg-gray">{{ $member->organ }}</span>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-2 px-2">
                <label class="form-label w-100">Titulação</label>
                <span class="fw-normal form-control bg-gray">{{ $member->titration }}</span>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 my-2 px-2">
                <label class="form-label w-100">CPF</label>
                <span class="fw-normal form-control bg-gray">{{ $member->cpf }}</span>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-2 px-2">
                <label class="form-label w-100">Aceite</label>
                <a class="btn btn-warning text-white" target="_blank" href="{{ route('file', substr($member->accept_member, 4)) }}">
                    VISUALIZAR
                </a>
            </div>
        </div>
    @endforeach
    <div class="d-flex justify-content-between">
        <div>
            <a class="btn btn-secondary text-white my-3"
                href="{{ route('manager.show', [$tcc->subject_id, $tcc->id]) }}">
                VOLTAR
            </a>
        </div>
        @if ($tcc->stage == 'Etapa 2' && $tcc->situation == 'Em análise')
            <div>
                <button type="button" class="btn btn-warning text-white me-2 my-3" data-bs-toggle="modal"
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
@endsection
