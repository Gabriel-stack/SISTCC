@extends('manager.templates.panel')

@section('title', 'ENTREGA DE TCC')

@section('container')
    @include('components.success')
    @include('components.fail')
    @include('components.auth-validation-errors')

    <div class="container">
        <div class="row justify-content-center">
            <div class="d-flex flex-wrap justify-content-center" style="max-width: 360px;">
                <div class="p-3" style="background: #FCFCFC; border: 1px solid #FFFFFF; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); border-radius: 4px;">
                    <div class="w-100 d-flex flex-wrap justify-content-center my-2">
                        <span class="w-100">TCC do aluno</span>
                        <a class="btn btn-warning w-auto" href="#">Baixar TCC</a>
                    </div>
                    <div class="w-100 d-flex flex-wrap justify-content-center my-2">
                        <span class="w-100">Declaração de depósito</span>
                        <a class="btn btn-warning w-auto" href="#">Baixar DECLARAÇÃO</a>
                    </div>
                </div>
                <div class="my-3 d-flex flex-wrap justify-content-end my-2 w-100 gap-2">
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
        </div>
    </div>
@endsection
