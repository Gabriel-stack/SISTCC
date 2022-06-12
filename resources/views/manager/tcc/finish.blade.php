@extends('manager.templates.panel')

@section('title', 'Entrega de TCC')

@section('container')
    <div class="col-12">
        @include('components.fail')
    </div>

    <div class="d-flex flex-wrap justify-content-center">
        <div style="width: 600px; max-width: 600px;">
            <div class="d-flex flex-column align-items-center bg-gray-400 box-shadow rounded-2 p-4">
                <div class="d-flex flex-column flex-wrap justify-content-center col-12 col-sm-6 my-2">
                    <span class="mb-1">TCC do aluno</span>
                    <a class="btn btn-warning w-auto text-white" href="#">BAIXAR</a>
                </div>
                <div class="d-flex flex-column flex-wrap justify-content-center col-12 col-sm-6 my-2">
                    <span class="mb-1">Declaração de depósito</span>
                    <a class="btn btn-warning w-auto text-white" href="#">BAIXAR</a>
                </div>
            </div>
            <div class="d-flex justify-content-between w-100 my-2">
                <div>
                    <a class="btn btn-secondary text-white my-2 me-2" href="{{ route('manager.show', [$tcc->subject_id, $tcc->id]) }}">
                        VOLTAR
                    </a>
                </div>
                @if ($tcc->stage == 'Etapa 3' && $tcc->situation == 'Em análise')
                    <div class="text-end">
                        <button type="button" class="btn btn-warning text-white my-2" data-bs-toggle="modal"
                            data-bs-target="#modal-return-tcc" data-tcc="{{ $tcc }}">
                            DEVOLVER
                        </button>
                        @include('manager.components.tcc.modal_return_tcc')

                        <button type="button" class="btn btn-success text-white my-2 ms-2" data-bs-toggle="modal"
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
