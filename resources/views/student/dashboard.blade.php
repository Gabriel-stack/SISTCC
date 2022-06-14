@extends('student.templates.panel')

@section('title', 'Acesso a turmas')

@section('container')
    <div class="col-12">
        @include('components.success')
        @include('components.fail')
        @include('components.auth-validation-errors')
    </div>

    <h4 class="d-inline fs-4">Turma atual</h4>
    <div class="d-flex justify-content-center py-3">
        @if (!$inside)
            <div class="card col-12 col-sm-11 bg-gray-400 box-shadow rounded-2">
                <div class="card-body">
                    <h4 class="d-inline fs-4">Entrar na turma</h4>
                    <form class="d-flex flex-wrap justify-content-center align-items-end w-100" action="{{ route('student.enroll') }}"
                        method="post">
                        @csrf
                        <p class="text-center mt-2 w-100">Peça para seu professor o código da turma e digite-o aqui.</p>
                        <input class="form-control mt-2 w-auto" type="text" name="code">
                        <button type="submit" class="btn btn-success text-center ms-2 mt-2">
                            <i class="bi bi-send"></i>
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div class="card col-12 col-md-6 bg-gray-400 box-shadow rounded-2">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title fs-5">{{ $active_class->class }}</h5>
                        <a class="btn btn-primary" href="{{ route('student.progress', $active_class->id) }}">
                            ACESSAR
                        </a>
                    </div>
                    <div class="d-flex flex-wrap justify-content-center mt-3">
                        <p class="card-text col-12 text-center fw-bold fs-5
                            @if ($inside->situation == 'Reprovado') text-danger">Reprovado
                            @elseif($inside->situation == 'Concluído') text-success">Concluído
                            @else text-warning">Cursando @endif
                        </p>
                        <div class="col-8 col-md-6 d-flex flex-column align-content-start mt-1 px-1">
                            <span class="mb-1">Data de início</span>
                            <span class="px-3 text-center py-1 bg-gray form-control fw-bold" style="height: 38px;">{{ @datebr($active_class->start_date) }}</span>
                        </div>
                        <div class="col-8 col-md-6 d-flex flex-column align-content-start mt-1 px-1">
                            <span class="mb-1">Data de término</span>
                            <span class="px-3 text-center py-1 bg-gray form-control fw-bold" style="height: 38px;">{{ @datebr($active_class->end_date) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <hr class="my-4 col-12 col-sm-11">

    <h4 class="d-inline fs-4">Turmas passadas</h4>
    <div class="d-flex flex-wrap justify-content-center py-3">
        @forelse($tccs as $tcc)
            <div class="card col-12 col-md-6 bg-gray-400 box-shadow rounded-2 m-2 py-2">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title fs-5">{{ $tcc->subject->class }}</h5>
                        <a class="btn btn-primary" href="{{ route('student.progress', $tcc->subject->id) }}">
                            ACESSAR
                        </a>
                    </div>
                    <div class="d-flex flex-wrap justify-content-center mt-3">
                        <p class="card-text col-12 text-center fw-bold fs-5
                            @if ($tcc->situation == 'Reprovado') text-danger">Reprovado
                            @elseif($tcc->situation == 'Concluído') text-success">Concluído
                            @else text-warning">Cursando @endif
                        </p>
                        <div class="col-8 col-md-6 d-flex flex-column align-content-start mt-1 px-1">
                            <span class="mb-1">Data de início</span>
                            <span class="px-3 text-center py-1 bg-gray form-control fw-bold" style="height: 38px;">
                                {{ @datebr($tcc->subject->start_date) }}
                            </span>
                        </div>
                        <div class="col-8 col-md-6 d-flex flex-column align-content-start mt-1 px-1">
                            <span class="mb-1">Data de término</span>
                            <span
                                class="px-3 text-center py-1 bg-gray form-control fw-bold" style="height: 38px;">{{ @datebr($tcc->subject->end_date) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="card col-12 col-sm-11 bg-gray-400 box-shadow rounded-2 py-4 px-1">
                <div class="card-body">
                    <h5 class="text-center fs-5 px-2">NÃO HÁ HISTÓRICO DE TURMAS!</h5>
                </div>
            </div>
        @endforelse
    </div>
@endsection
