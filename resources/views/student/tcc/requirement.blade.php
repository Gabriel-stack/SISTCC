@extends('student.templates.panel')

@section('title', 'REQUERIMENTO DE DEFESA')

@section('container')

    @include('components.success')
    @include('components.fail')
    @include('components.auth-validation-errors')

    <form class="container" action="{{ route('student.progress.requirement.store') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="row justify-content-center align-items-center p-3 box-shadow my-3 bg-gray-400">
            <div class="col-12 col-sm-6 col-lg-3 py-2">
                <label for="consert_professor" class="form-label">Termo de anuência</label>
                <input type="file" class="form-control" name="consert_professor" id="consert_professor">
            </div>
            <div class="col-12 col-sm-6 col-lg-3 py-2">
                <label for="file_tcc" class="form-label">TCC finalizado</label>
                <input type="file" class="form-control" name="file_tcc" id="file_tcc">
            </div>
            @if ($ethics_committee)
                <div class="col-12 col-sm-6 col-lg-3 py-2">
                    <label for="result_ethic_commitee" class="form-label">Parecer do comitê de ética</label>
                    <input type="file" class="form-control" name="result_ethic_commitee" id="result_ethic_commitee">
                </div>
            @endif
            <div class="col-12 col-sm-6 col-lg-3 py-2">
                <label for="proof_article_submission" class="form-label">Comprovante de submissão do artigo</label>
                <input type="file" class="form-control" name="proof_article_submission" id="proof_article_submission">
            </div>
        </div>
        <div class="row align-items-baseline p-3 box-shadow my-3 bg-gray-400">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="my-3">
                    <label for="photo" class="form-label">Foto 3x4</label>
                    <input type="file" class="form-control" name="photo" id="photo">
                </div>
                <div class="my-3">
                    <label for="intended_date" class="form-label">Data de defesa</label>
                    <input type="datetime-local" class="form-control" name="intended_date" id="intended_date">
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="my-3">
                    <label for="type_tcc" class="form-label">Tipo de TCC</label>
                    <input type="text" class="form-control" name="type_tcc" id="type_tcc">
                </div>
                <div class="my-3">
                    <label for="keywords" class="form-label">Palavras-chave</label>
                    <input type="text" class="form-control" name="keywords" id="keywords">
                </div>
            </div>
            <div class="col-12 col-lg-6 d-flex flex-column">
                <label for="abstract" class="form-label">Resumo</label>
                <textarea name="abstract" id="abstract" cols="30" rows="5"></textarea>
            </div>
        </div>
        <div class="row align-items-baseline p-3 box-shadow my-3 bg-gray-400">
            <div class="col-12">
                <p class="title">MEMBRO 1</p>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
                <label for="members[one][name]" class="form-label">Nome</label>
                <input type="text" class="form-control" name="members[one][name]" id="name">
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
                <label for="members[one][titration]" class="form-label">Titulação</label>
                <input type="text" class="form-control" name="members[one][titration]" id="members[one][titration]">
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
                <label for="members[one][organ]" class="form-label">Orgão</label>
                <input type="text" class="form-control" name="members[one][organ]" id="members[one][organ]">
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
                <label for="members[one][accept_member]" class="form-label">Aceite</label>
                <input type="file" class="form-control" name="members[one][accept_member]"
                    id="members[one][accept_member]">
            </div>
        </div>
        <div class="row align-items-baseline p-3 box-shadow my-3 bg-gray-400">
            <div class="col-12">
                <p class="title">MEMBRO 2</p>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
                <label for="members[two][name]" class="form-label">Nome</label>
                <input type="text" class="form-control" name="members[two][name]" id="members[two][name]">
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
                <label for="members[two][titration]" class="form-label">Titulação</label>
                <input type="text" class="form-control" name="members[two][titration]" id="members[two][titration]">
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
                <label for="members[two][organ]" class="form-label">Orgão</label>
                <input type="text" class="form-control" name="members[two][organ]" id="members[two][organ]">
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
                <label for="members[two][accept_member]" class="form-label">Aceite</label>
                <input type="file" class="form-control" name="members[two][accept_member]"
                    id="members[two][accept_member]">
            </div>
        </div>
        <div class="row align-items-baseline p-3 box-shadow my-3 bg-gray-400">
            <div class="col-12">
                <p class="title">MEMBRO 3 (Opcional)</p>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
                <label for="members[three][name]" class="form-label">Nome</label>
                <input type="text" class="form-control" name="members[three][name]" id="members[three][name]">
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
                <label for="members[three][titration]" class="form-label">Titulação</label>
                <input type="text" class="form-control" name="members[three][titration]" id="members[three][titration]">
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
                <label for="members[three][organ]" class="form-label">Orgão</label>
                <input type="text" class="form-control" name="members[three][organ]" id="members[three][organ]">
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
                <label for="members[three][accept_member]" class="form-label">Aceite</label>
                <input type="file" class="form-control" name="members[three][accept_member]"
                    id="members[three][accept_member]">
            </div>
        </div>
        <div class="my-3 text-end">
            <a class="btn btn-secondary" href="{{ route('student.progress', $subject_id) }}">VOLTAR</a>
            <button class="btn btn-success" type="submit">ENVIAR</button>
        </div>
    </form>
@endsection
