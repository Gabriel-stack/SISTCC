@extends('student.templates.panel')

@section('title', 'Requerimento de defesa')

@section('container')
    <div class="col-12">
        @if ($tcc->stage == 'Etapa 1' && $tcc->situation == 'Devolvido')
            <div class="alert alert-danger text-center">
                <p class="fs-5">{{ $tcc->message }}</p>
            </div>
        @endif

        @include('components.fail')
        @include('components.auth-validation-errors')
    </div>

    <form action="{{ route('student.progress.requirement.store', $tcc->subject_id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf

        <div class="d-flex flex-wrap align-items-baseline bg-gray-400 box-shadow rounded-2 p-3 mb-3">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="my-2 px-2">
                    <label for="photo" class="form-label">Foto 3x4</label>
                    <input type="file" class="form-control" name="photo" id="photo">
                </div>
                <div class="my-2 px-2">
                    <label for="intended_date" class="form-label">Data de defesa</label>
                    <input type="datetime-local" class="form-control" name="intended_date" id="intended_date"
                        value="@if($tcc->intended_date) date('Y-m-d\TH:i:s', strtotime($tcc->intended_date)) @endif">
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="my-2 px-2">
                    <label for="type_tcc" class="form-label">Tipo de TCC</label>
                    <select class="form-select" name="type_tcc" id="type_tcc">
                        <option class="text-muted" @if (!$tcc->proof_article_submission) disabled selected @endif>Selecione</option>
                        <option value="artigo" @if ($tcc->proof_article_submission) selected @endif>Artigo</option>
                        <option value="cap_livro">Capítulo de Livro</option>
                        <option value="monografia">Monografia</option>
                        <option value="outro">Outro</option>
                    </select>

                </div>
                <div class="my-2 px-2">
                    <label for="keywords" class="form-label">Palavras-chave</label>
                    <input type="text" class="form-control" name="keywords" id="keywords"
                        value="{{ $tcc->keywords ?? '' }}">
                </div>
            </div>
            <div class="col-12 col-lg-6 d-flex flex-column px-2">
                <label for="abstract" class="form-label">Resumo</label>
                <textarea class="p-2" name="abstract" id="abstract" cols="30" rows="4">{{ $tcc->abstract ?? '' }}</textarea>
            </div>
        </div>

        <div
            class="d-flex flex-wrap justify-content-center align-items-center bg-gray-400 box-shadow rounded-2 p-3 my-3 px-2">
            <div class="col-12 col-sm-6 col-lg-3 p-2">
                <label for="file_tcc" class="form-label">TCC finalizado</label>
                <input type="file" class="form-control" name="file_tcc" id="file_tcc">
            </div>
            @if ($tcc->ethics_committee)
                <div class="col-12 col-sm-6 col-lg-3 my-2 p-2">
                    <label for="result_ethic_committee" class="form-label">Parecer do comitê de ética</label>
                    <input type="file" class="form-control" name="result_ethic_committee" id="result_ethic_committee">
                </div>
            @endif
            <div class="col-12 col-sm-6 col-lg-3 my-2 p-2" id="proof_article"
                style="@if (!$tcc->proof_article_submission) display: none; @endif">
                <label for="proof_article_submission" class="form-label">Comprovante de submissão do artigo</label>
                <input type="file" class="form-control" name="proof_article_submission" id="proof_article_submission"
                    @if (!$tcc->proof_article_submission) disabled @endif>
            </div>
        </div>

        <div class="d-flex flex-wrap align-items-baseline bg-gray-400 box-shadow rounded-2 p-3 my-3 px-2">
            <div class="col-12">
                <h5 class="fs-5 fw-bold px-2">Orientador</h5>
            </div>
            <hr>
            <div class="col-12 col-sm-12 col-md-6 my-2 px-2">
                <label class="form-label">Nome</label>
                <p class="form-control bg-gray text-muted">{{ $tcc->professor->name }}</p>
            </div>
            <div class="col-12 col-sm-12 col-md-6 my-2 px-2">
                <label class="form-label">Titulação</label>
                <p class="form-control bg-gray text-muted">{{ $tcc->professor->titration }}</p>
            </div>
            <div class="col-12 col-sm-12 col-md-6 my-2 px-2">
                <label class="form-label">Orgão</label>
                <p class="form-control bg-gray text-muted">{{ $tcc->professor->organ }}</p>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 my-2 px-2">
                <label class="form-label">CPF</label>
                <p class="form-control bg-gray text-muted">{{ $tcc->professor->cpf }}</p>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-2 px-2">
                <label for="consent_professor" class="form-label">Termo de anuência</label>
                <input type="file" class="form-control" name="consent_professor" id="consent_professor">
            </div>
        </div>

        <div class="d-flex flex-wrap align-items-baseline bg-gray-400 box-shadow rounded-2 p-3 my-3 px-2">
            <div class="col-12">
                <h5 class="fs-5 fw-bold px-2">Membro 1</h5>
            </div>
            <hr>
            <div class="col-12 col-sm-12 col-md-6 my-2 px-2">
                <label for="members[one][name]" class="form-label">Nome</label>
                <input type="text" class="form-control" name="members[one][name]" id="name"
                    value="{{ json_decode($tcc->members)->one->name ?? '' }}">
            </div>
            <div class="col-12 col-sm-12 col-md-6 my-2 px-2">
                <label for="members[one][titration]" class="form-label">Titulação</label>
                <input type="text" class="form-control" name="members[one][titration]" id="members[one][titration]"
                    value="{{ json_decode($tcc->members)->one->titration ?? '' }}">
            </div>
            <div class="col-12 col-sm-12 col-md-6 my-2 px-2">
                <label for="members[one][organ]" class="form-label">Orgão</label>
                <input type="text" class="form-control" name="members[one][organ]" id="members[one][organ]"
                    value="{{ json_decode($tcc->members)->one->organ ?? '' }}">
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 my-2 px-2">
                <label for="members[one][cpf]" class="form-label">CPF</label>
                <input type="text" class="form-control cpf" name="members[one][cpf]"
                    value="{{ json_decode($tcc->members)->one->cpf ?? '' }}">
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-2 px-2">
                <label for="members[one][accept_member]" class="form-label">Aceite</label>
                <input type="file" class="form-control" name="members[one][accept_member]"
                    id="members[one][accept_member]">
            </div>
        </div>

        <div class="d-flex flex-wrap align-items-baseline bg-gray-400 box-shadow rounded-2 p-3 my-3 px-2">
            <div class="col-12">
                <h5 class="fs-5 fw-bold px-2">Membro 2</h5>
            </div>
            <hr>
            <div class="col-12 col-sm-12 col-md-6 my-2 px-2">
                <label for="members[two][name]" class="form-label">Nome</label>
                <input type="text" class="form-control" name="members[two][name]" id="members[two][name]"
                    value="{{ json_decode($tcc->members)->two->name ?? '' }}">
            </div>
            <div class="col-12 col-sm-12 col-md-6 my-2 px-2">
                <label for="members[two][titration]" class="form-label">Titulação</label>
                <input type="text" class="form-control" name="members[two][titration]" id="members[two][titration]"
                    value="{{ json_decode($tcc->members)->two->titration ?? '' }}">
            </div>
            <div class="col-12 col-sm-12 col-md-6 my-2 px-2">
                <label for="members[two][organ]" class="form-label">Orgão</label>
                <input type="text" class="form-control" name="members[two][organ]" id="members[two][organ]"
                    value="{{ json_decode($tcc->members)->two->organ ?? '' }}">
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 my-2 px-2">
                <label for="members[two][cpf]" class="form-label">CPF</label>
                <input type="text" class="form-control cpf" name="members[two][cpf]"
                    value="{{ json_decode($tcc->members)->two->cpf ?? '' }}">
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-2 px-2">
                <label for="members[two][accept_member]" class="form-label">Aceite</label>
                <input type="file" class="form-control" name="members[two][accept_member]"
                    id="members[two][accept_member]">
            </div>
        </div>

        <div class="d-flex flex-wrap align-items-baseline bg-gray-400 box-shadow rounded-2 p-3 my-3 px-2">
            <div class="col-12">
                <h5 class="fs-5 fw-bold px-2">Membro 3 (Opcional)</h5>
            </div>
            <div class="col-col-12 col-sm-12 col-md-6 my-2 px-2">
                <label for="members[three][name]" class="form-label">Nome</label>
                <input type="text" class="form-control" name="members[three][name]" id="members[three][name]"
                    value="{{ json_decode($tcc->members)->three->name ?? '' }}">
            </div>
            <div class="col-12 col-sm-12 col-md-6 my-2 px-2">
                <label for="members[three][titration]" class="form-label">Titulação</label>
                <input type="text" class="form-control" name="members[three][titration]" id="members[three][titration]"
                    value="{{ json_decode($tcc->members)->three->titration ?? '' }}">
            </div>
            <div class="col-12 col-sm-12 col-md-6 my-2 px-2">
                <label for="members[three][organ]" class="form-label">Orgão</label>
                <input type="text" class="form-control" name="members[three][organ]" id="members[three][organ]"
                    value="{{ json_decode($tcc->members)->three->organ ?? '' }}">
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-3 my-2 px-2">
                <label for="members[three][cpf]" class="form-label">CPF</label>
                <input type="text" class="form-control cpf" name="members[three][cpf]"
                    value="{{ json_decode($tcc->members)->three->cpf ?? '' }}">
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-2 px-2">
                <label for="members[three][accept_member]" class="form-label">Aceite</label>
                <input type="file" class="form-control" name="members[three][accept_member]"
                    id="members[three][accept_member]">
            </div>
        </div>

        <div class="d-flex justify-content-between my-3">
            <a class="btn btn-secondary" href="{{ route('student.progress', $subject_id) }}">VOLTAR</a>
            <button class="btn btn-success" type="submit">ENVIAR</button>
        </div>
    </form>
    @section('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
        <script>
            let select = document.querySelector('#type_tcc');
            select.addEventListener('change', function() {
                console.log(select.value);
                if (select.value == 'artigo') {
                    document.querySelector('#proof_article').style.display = 'block';
                    document.querySelector('#proof_article_submission').disabled = false;
                } else {
                    document.querySelector('#proof_article').style.display = 'none';
                    document.querySelector('#proof_article_submission').disabled = true;
                }
            });
            let cpfs = $('.cpf');
            cpfs.each(function(cpf) {
                $(this).mask('000.000.000-00', {reverse: true});
            });
        </script>
    @endsection
@endsection
