@extends('student.templates.panel')

@section('title', 'Entrega de TCC')

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
    <form class="d-flex flex-wrap justify-content-center mb-4" action="{{ route('student.progress.finish.store', $tcc->subject_id) }}"
        method="POST" enctype="multipart/form-data">
        @csrf

        <div style="max-width: 360px;">
            <div class="d-flex flex-wrap flex-column align-items-center bg-gray-400 box-shadow rounded-2 p-4">
                <div class="col-12">
                    <div class="mb-3">
                        <label for="final_tcc" class="form-label">Anexar TCC</label>
                        <input class="form-control" id="final_tcc" type="file" name="final_tcc">
                    </div>
                </div>
                <div class="col-12">
                    <div class="">
                        <label for="deposit_statement" class="form-label">Anexar declaração de depósito</label>
                        <input class="form-control" id="deposit_statement" type="file" name="deposit_statement">
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between my-3">
                <a class="btn btn-secondary" href="{{ route('student.progress', $subject_id) }}">VOLTAR</a>
                <button class="btn btn-success" type="submit">ENVIAR</button>
            </div>
        </div>
    </form>
@endsection
