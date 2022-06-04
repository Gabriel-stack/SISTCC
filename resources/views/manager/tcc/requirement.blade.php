@extends('manager.templates.panel')

@section('title', 'REQUERIMENTO DE DEFESA')

@section('container')
    @include('components.success')
    @include('components.fail')
    @include('components.auth-validation-errors')

    <form class="container" action="" method="POST" enctype="multipart/form-data">
        <div class="row align-items-center p-3 box-shadow my-3 bg-gray-400">
            <div class="col-12 col-sm-6 col-lg-3 py-2">
                <label for="consert_professor" class="form-label">Termo de anuência</label>
                <input type="file" class="form-control" name="tt[]" id="consert_advisor">
            </div>
            <div class="col-12 col-sm-6 col-lg-3 py-2">
                <label for="file_tcc" class="form-label">TCC finalizado</label>
                <input type="file" class="form-control" name="tt[]" id="file_tcc">
            </div>
            <div class="col-12 col-sm-6 col-lg-3 py-2">
                <label for="result_ethics_commitee" class="form-label">Parecer do comitê de ética</label>
                <input type="file" class="form-control" name="result_ethics_commitee" id="result_ethics_commitee">
            </div>
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
                    <input type="datetime" class="form-control" name="intended_date" id="intended_date">
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
                <label for="name_member_1" class="form-label">Nome</label>
                <input type="text" class="form-control" name="name_member_1" id="name_member_1">
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
                <label for="titration_member_1" class="form-label">Titulação</label>
                <input type="datetime" class="form-control" name="titration_member_1" id="titration_member_1">
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
                <label for="organ_member_1" class="form-label">Orgão</label>
                <input type="text" class="form-control" name="organ_member_1" id="organ_member_1">
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
                <label for="accept_member_1" class="form-label">Aceite</label>
                <input type="file" class="form-control" name="accept_member_1" id="accept_member_1">
            </div>
        </div>
        <div class="row align-items-baseline p-3 box-shadow my-3 bg-gray-400">
            <div class="col-12">
                <p class="title">MEMBRO 2</p>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
                <label for="name_member_2" class="form-label">Nome</label>
                <input type="text" class="form-control" name="name_member_2" id="name_member_2">
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
                <label for="titration_member_2" class="form-label">Titulação</label>
                <input type="datetime" class="form-control" name="titration_member_2" id="titration_member_2">
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
                <label for="organ_member_2" class="form-label">Orgão</label>
                <input type="text" class="form-control" name="organ_member_2" id="organ_member_2">
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
                <label for="accept_member_2" class="form-label">Aceite</label>
                <input type="file" class="form-control" name="accept_member_2" id="accept_member_2">
            </div>
        </div>
        <div class="row align-items-baseline p-3 box-shadow my-3 bg-gray-400">
            <div class="col-12">
                <p class="title">MEMBRO 3 (Opcional)</p>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
                <label for="name_member_3" class="form-label">Nome</label>
                <input type="text" class="form-control" name="name_member_3" id="name_member_3">
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
                <label for="titration_member_3" class="form-label">Titulação</label>
                <input type="datetime" class="form-control" name="titration_member_3" id="titration_member_3">
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
                <label for="organ_member_3" class="form-label">Orgão</label>
                <input type="text" class="form-control" name="organ_member_3" id="organ_member_3">
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 my-3">
                <label for="accept_member_3" class="form-label">Aceite</label>
                <input type="file" class="form-control" name="accept_member_3" id="accept_member_3">
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
    </form>
@endsection
