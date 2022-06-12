@extends('manager.templates.panel')

@section('title', 'Entrega de TCC')

@section('container')
    @include('components.success')
    @include('components.fail')
    @include('components.auth-validation-errors')

    <div class="d-flex flex-wrap justify-content-center">
        <div class="col-12 col-sm-11 py-3">
            <div class="d-flex flex-wrap justify-content-center">
                <div class="d-flex flex-wrap justify-content-center" style="max-width: 600px;">
                    <div class="p-3 d-flex flex-column align-items-center"
                        style="background: #FCFCFC; border: 1px solid #FFFFFF; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); width: 600px; border-radius: 4px;">
                        <div class="d-flex flex-column flex-wrap justify-content-center col-12 col-sm-6 col-md-4 my-2">
                            <span class="mb-1">TCC do aluno</span>
                            <a class="btn btn-warning w-auto text-white" href="#">BAIXAR</a>
                        </div>
                        <div class="d-flex flex-column flex-wrap justify-content-center col-12 col-sm-6 col-md-4 my-2">
                            <span class="mb-1">Declaração de depósito</span>
                            <a class="btn btn-warning w-auto text-white" href="#">BAIXAR</a>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between gap-2 w-100 my-3">
                        <div>
                            <a class="btn btn-secondary text-white my-3"
                                href="{{ route('manager.show', [$tcc->subject_id, $tcc->id]) }}">
                                VOLTAR
                            </a>
                        </div>
                        @if ($tcc->stage == 'Etapa 3' && $tcc->situation == 'Em análise')
                            <div>
                                <button type="button" class="btn btn-warning text-white my-3" data-bs-toggle="modal"
                                    data-bs-target="#modal-return-tcc" data-tcc="{{ $tcc }}">
                                    DEVOLVER
                                </button>
                                @include('manager.components.tcc.modal_return_tcc')

                                <button type="button" class="btn btn-danger text-white my-3" data-bs-toggle="modal"
                                    data-bs-target="#modal-disapprove-tcc" data-tcc="{{ $tcc }}">
                                    REPROVAR
                                </button>
                                @include('manager.components.tcc.modal_disapprove_tcc')

                                <button type="button" class="btn btn-success text-white my-3" data-bs-toggle="modal"
                                    data-bs-target="#modal-approve-tcc" data-tcc="{{ $tcc }}">
                                    APROVAR
                                </button>
                                @include('manager.components.tcc.modal_approve_tcc')
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
