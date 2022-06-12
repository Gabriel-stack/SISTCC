@extends('manager.templates.panel')

@section('title', 'Requerimento de defesa')

@section('container')
    @include('components.success')
    @include('components.fail')
    @include('components.auth-validation-errors')

    <div class="d-flex flex-wrap justify-content-center">
        <div class="col-12 col-sm-11 py-3">
            <div class="d-flex flex-wrap align-items-center p-3 box-shadow my-3 bg-gray-400">
                <div class="col-3">
                    <a class="text-decoration-none text-dark" href="{{ route('file', $tcc->consent_professor) }}">
                        <i class="bi bi-filetype-pdf"> </i>Termo de anuência</a>
                </div>
                <div class="col-3">
                    <a class="text-decoration-none text-dark" href="{{ route('file', $tcc->file_tcc) }}">
                        <i class="bi bi-filetype-pdf"> </i>TCC finalizado</a>
                </div>
                @if ($tcc->result_ethic_commitee)
                <div class="col-3">
                    <a class="text-decoration-none text-dark" href="{{ route('file', $tcc->result_ethic_commitee) }}">
                        <i class="bi bi-filetype-pdf"> </i>Parecer do comitê de ética</a>
                </div>
                @endif
                <div class="col-3">
                    <a class="text-decoration-none text-dark" href="{{ route('file', $tcc->proof_article_submission) }}">
                        <i class="bi bi-filetype-pdf"> </i>Comprovante de submissão do artigo</a>
                </div>
            </div>
            <div class="d-flex flex-wrap align-items-start p-3 box-shadow my-3 bg-gray-400">
                <div class="col-12 col-md-2">
                    <div>
                        <img src="{{ storage_path("app/public/{$tcc->photo}") }}" alt="" width="113px" height="151px"> <!-- Consertar! -->
                    </div>
                </div>
                <div class="d-flex flex-column col-12 col-md-6 col-lg-4">
                    <div class="my-3">
                        <h6>Tipo do TCC: <span class="fw-normal">{{ $tcc->title }}</span></h6>
                    </div>
                    <div class="mb-3">
                        <h6>Palavras-chaves: <span class="fw-normal">{{ $tcc->keywords }}</span></h6>
                    </div>
                    <div class="mb-3">
                        <h6>Data que pretende defender: <span class="fw-normal">{{ @datebr($tcc->intended_date) }}</span>
                        </h6>
                    </div>
                </div>
                <div class="col-12 col-lg-6 d-flex flex-column">
                    <textarea class="overflow-y" name="abstract" id="abstract" cols="30" rows="6"
                        disabled>{{ $tcc->abstract }}</textarea>
                </div>
            </div>
            <div class="d-flex flex-wrap align-items-start justify-content-center p-3 box-shadow my-3 bg-gray-400">
                @foreach ($members as $member)
                <div class="col-12 col-sm-6 col-md-3">
                    <h6>Nome: <span class="fw-normal">{{ $member->name }}</span></h6>
                    <h6>Titulação: <span class="fw-normal">{{ $member->titration }}</span></h6>
                    <h6>Orgão: <span class="fw-normal">{{ $member->organ }}</span></h6>
                    <a class="text-decoration-none text-dark" href="{{ $member->accept_member }}"><i class="bi bi-filetype-pdf">
                        </i>Aceite</a>
                </div>
                @endforeach
            </div>
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
        </div>
    </div>
@endsection
