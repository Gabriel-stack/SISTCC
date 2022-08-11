@extends('student.templates.panel')

@section('title', 'Entrega de TCC')

@section('container')
    <div class="d-flex flex-wrap justify-content-center">
        <div style="width: 600px; max-width: 600px;">
            <div class="d-flex flex-column align-items-center bg-gray-400 box-shadow rounded-2 p-4">
                <div class="d-flex flex-column flex-wrap justify-content-center col-12 col-sm-6 my-2">
                    <span class="mb-1">TCC do aluno</span>
                    <a class="btn btn-warning w-auto text-white" target="_blank" href="{{route('file', substr($tcc->final_tcc, 4))}}">
                        VISUALIZAR
                    </a>
                </div>
                <div class="d-flex flex-column flex-wrap justify-content-center col-12 col-sm-6 my-2">
                    <span class="mb-1">Declaração de depósito</span>
                    <a class="btn btn-warning w-auto text-white"  target="_blank" href="{{ route('file', substr($tcc->deposit_statement, 4)) }}">
                        VISUALIZAR
                    </a>
                </div>
            </div>
            <div class="my-3">
                <a class="btn btn-secondary text-white" href="{{ route('student.progress', [$tcc->subject_id]) }}">VOLTAR</a>
            </div>
        </div>
    </div>
@endsection
