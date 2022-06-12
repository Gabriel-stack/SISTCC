@extends('student.templates.panel')

@section('title', 'Entrega de TCC')

@section('container')
    @include('components.success')
    @include('components.fail')
    @include('components.auth-validation-errors')

    <div class="d-flex flex-wrap justify-content-center">
        <div class="col-12 col-sm-11 py-3">
            <form class="container d-flex flex-wrap justify-content-center mb-4" action="{{ route('student.progress.finish.store', $tcc->subject_id) }}"
                method="POST" enctype="multipart/form-data">
                @csrf

                <div style="max-width: 360px;">
                    <div class="row flex-column align-items-center bg-white box-shadow rounded-2 p-2">
                        <div class="col-12">
                            <div class="my-3">
                                <label for="final_tcc" class="form-label">Anexar TCC</label>
                                <input class="form-control" id="final_tcc" type="file" name="final_tcc">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="my-3">
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
        </div>
    </div>
@endsection
