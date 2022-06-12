@extends('student.templates.panel')

@section('title', 'Requerimento de defesa')

@section('container')
    @include('components.success')
    @include('components.fail')
    @include('components.auth-validation-errors')

    <div class="d-flex flex-wrap justify-content-center">
        <div class="col-12 col-sm-11 py-3">
            <form action="{{ route('student.progress.requirement.store', $tcc->subject_id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <div class="d-flex flex-wrap align-items-baseline p-3 box-shadow mb-3 bg-gray-400">
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="my-2 px-2">
                            <label for="photo" class="form-label">Foto 3x4</label>
                            <input type="file" class="form-control" name="photo" id="photo">
                        </div>
                        <div class="my-2 px-2">
                            <label for="intended_date" class="form-label">Data de defesa</label>
                            <input type="datetime-local" class="form-control" name="intended_date" id="intended_date" value="{{ old('intended_date') }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="my-2 px-2">
                            <label for="type_tcc" class="form-label">Tipo de TCC</label>
                            <select class="form-select" name="type_tcc" id="type_tcc">
                                <option class="text-muted" selected>Selecione</option>
                                <option value="artigo">Artigo</option>
                                <option value="cap_livro">Capítulo de Livro</option>
                                <option value="monografia">Monografia</option>
                                <option value="outro">Outro</option>
                            </select>

                        </div>
                        <div class="my-2 px-2">
                            <label for="keywords" class="form-label">Palavras-chave</label>
                            <input type="text" class="form-control" name="keywords" id="keywords" value="{{ old('keywords') }}">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 d-flex flex-column px-2">
                        <label for="abstract" class="form-label">Resumo</label>
                        <textarea class="p-2" name="abstract" id="abstract" cols="30" rows="4">{{ old('abstract') }}</textarea>
                    </div>
                </div>
                <div class="d-flex flex-wrap justify-content-center align-items-center p-3 box-shadow my-2 px-2 bg-gray-400">
                    <div class="col-12 col-sm-6 col-lg-3 p-2">
                        <label for="file_tcc" class="form-label">TCC finalizado</label>
                        <input type="file" class="form-control" name="file_tcc" id="file_tcc">
                    </div>
                    @if ($ethics_committee)
                        <div class="col-12 col-sm-6 col-lg-3 my-2 p-2">
                            <label for="result_ethic_commitee" class="form-label">Parecer do comitê de ética</label>
                            <input type="file" class="form-control" name="result_ethic_commitee" id="result_ethic_commitee">
                        </div>
                    @endif
                    <div class="col-12 col-sm-6 col-lg-3 my-2 p-2" id="proof_article" style="display: none;">
                        <label for="proof_article_submission" class="form-label">Comprovante de submissão do artigo</label>
                        <input type="file" class="form-control" name="proof_article_submission" id="proof_article_submission" disabled>
                    </div>
                </div>
                <div class="d-flex flex-wrap align-items-baseline p-3 box-shadow my-2 px-2 bg-gray-400">
                    <div class="col-12">
                        <h5 class="fs-5 fw-bold px-2">Orientador</h5>
                    </div><hr>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-2 px-2">
                        <label class="form-label">Nome</label>
                        <p class="form-control bg-gray text-muted">{{$tcc->professor->name}}</p>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-2 px-2">
                        <label class="form-label">CPF</label>
                        <p class="form-control bg-gray text-muted">{{$tcc->professor->cpf}}</p>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-2 px-2">
                        <label class="form-label">Titulação</label>
                        <p class="form-control bg-gray text-muted">{{$tcc->professor->titration}}</p>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-2 px-2">
                        <label class="form-label">Orgão</label>
                        <p class="form-control bg-gray text-muted">{{$tcc->professor->organ}}</p>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-2 px-2">
                        <label for="consent_professor" class="form-label">Termo de anuência</label>
                        <input type="file" class="form-control" name="consent_professor" id="consent_professor">
                    </div>
                </div>
                <div class="d-flex flex-wrap align-items-baseline p-3 box-shadow my-2 px-2 bg-gray-400">
                    <div class="col-12">
                        <h5 class="fs-5 fw-bold px-2">Membro 1</h5>
                    </div><hr>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-2 px-2">
                        <label for="members[one][name]" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="members[one][name]" id="name" value="{{ old('members[one][name]') }}">
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-2 px-2">
                        <label for="members[one][cpf]" class="form-label">CPF</label>
                        <input type="text" class="form-control" name="members[one][cpf]" id="cpf" value="{{ old('members[one][cpf]') }}">
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-2 px-2">
                        <label for="members[one][titration]" class="form-label">Titulação</label>
                        <input type="text" class="form-control" name="members[one][titration]" id="members[one][titration]" value="{{ old('members[one][titration]') }}">
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-2 px-2">
                        <label for="members[one][organ]" class="form-label">Orgão</label>
                        <input type="text" class="form-control" name="members[one][organ]" id="members[one][organ]" value="{{ old('members[one][organ]') }}">
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-2 px-2">
                        <label for="members[one][accept_member]" class="form-label">Aceite</label>
                        <input type="file" class="form-control" name="members[one][accept_member]"
                            id="members[one][accept_member]">
                    </div>
                </div>
                <div class="d-flex flex-wrap align-items-baseline p-3 box-shadow my-2 px-2 bg-gray-400">
                    <div class="col-12">
                        <h5 class="fs-5 fw-bold px-2">Membro 2</h5>
                    </div><hr>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-2 px-2">
                        <label for="members[two][name]" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="members[two][name]" id="members[two][name]" value="{{ old('members[two][name]')}}">
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-2 px-2">
                        <label for="members[two][cpf]" class="form-label">CPF</label>
                        <input type="text" class="form-control" name="members[two][cpf]" id="cpf" value="{{ old('members[two][cpf]') }}">
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-2 px-2">
                        <label for="members[two][titration]" class="form-label">Titulação</label>
                        <input type="text" class="form-control" name="members[two][titration]" id="members[two][titration]" value="{{ old('members[two][titration]') }}">
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-2 px-2">
                        <label for="members[two][organ]" class="form-label">Orgão</label>
                        <input type="text" class="form-control" name="members[two][organ]" id="members[two][organ]" value="{{ old('members[two][organ]') }}">
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-2 px-2">
                        <label for="members[two][accept_member]" class="form-label">Aceite</label>
                        <input type="file" class="form-control" name="members[two][accept_member]"
                            id="members[two][accept_member]">
                    </div>
                </div>
                <div class="d-flex flex-wrap align-items-baseline p-3 box-shadow my-2 px-2 bg-gray-400">
                    <div class="col-12">
                        <h5 class="fs-5 fw-bold px-2">Membro 3 (Opcional)</h5>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-2 px-2">
                        <label for="members[three][name]" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="members[three][name]" id="members[three][name]" value="{{ old('members[three][name]') }}">
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-2 px-2">
                        <label for="members[three][cpf]" class="form-label">CPF</label>
                        <input type="text" class="form-control" name="members[three][cpf]" id="cpf" value="{{ old('members[three][cpf]') }}">
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-2 px-2">
                        <label for="members[three][titration]" class="form-label">Titulação</label>
                        <input type="text" class="form-control" name="members[three][titration]" id="members[three][titration]" value="{{ old('members[three][titration]') }}">
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-2 px-2">
                        <label for="members[three][organ]" class="form-label">Orgão</label>
                        <input type="text" class="form-control" name="members[three][organ]" id="members[three][organ]" value="{{ old('members[three][organ]') }}">
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-2 px-2">
                        <label for="members[three][accept_member]" class="form-label">Aceite</label>
                        <input type="file" class="form-control" name="members[three][accept_member]" id="members[three][accept_member]">
                    </div>
                </div>
                <div class="d-flex justify-content-between my-3">
                    <a class="btn btn-secondary" href="{{ route('student.progress', $subject_id) }}">VOLTAR</a>
                    <button class="btn btn-success" type="submit">ENVIAR</button>
                </div>
            </form>
        </div>
    </div>

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
    </script>
@endsection
