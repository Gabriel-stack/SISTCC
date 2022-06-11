@extends('student.templates.panel')

@section('title', 'Acesso a turma')

@section('container')
    @include('components.success')
    @include('components.fail')
    @include('components.auth-validation-errors')

    <div class="my-3">
        <div class="d-flex flex-column">
            @if (!$inside)
                <div class="d-flex justify-content-center box-shadow my-3 py-4 px-1">
                    <div class="d-flex flex-column align-content-around my-3 w-75">
                        <div class="row">
                            <h3 class="d-inline fs-4">Entrar na turma</h3>
                        </div>
                        <div class="row">
                            <form action="student.enroll" method="post">
                            <div class="d-flex flex-wrap align-items-center justify-content-center ps-0">
                                <p class="col-12 col-lg-6 my-1 px-2 text-md-start text-lg-center text-xl-end">Digite o código
                                    da turma disponibilizado pelo professor: </p>
                                <input class="form-control w-auto" type="text" name="code">
                                <a class="btn btn-success text-center ms-2"
                                    href="{{ route('student.progress', $active_class) }}">
                                    <i class="bi bi-send"></i>
                                </a>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            @else
                <div class="my-3">
                    <h3 class="d-inline fs-4">Turma atual</h3>
                    <div class="mt-3 d-flex justify-content-center">
                        <div class="d-flex justify-content-center box-shadow bg-white py-4 px-3" style="max-width: 600px;">
                            <div>
                                <div class="d-flex justify-content-between">
                                    <h5 class="title fs-4">{{ $active_class->class }}</h5>
                                </div>
                                <div class="d-flex flex-wrap justify-content-center mt-3">
                                    <div class="col-8 col-sm-6 col-md-4 d-flex flex-column align-content-start px-1">
                                        <span class="mb-1">Data de início</span>
                                        <span
                                            class="px-4 text-center py-1 bg-gray fw-bold" style="height: 38px;">{{ @datebr($active_class->start_date) }}</span>
                                    </div>
                                    <div class="col-8 col-sm-6 col-md-4 d-flex flex-column align-content-start px-1">
                                        <span class="mb-1">Data de término</span>
                                        <span
                                            class="px-4 text-center py-1 bg-gray fw-bold" style="height: 38px;">{{ @datebr($active_class->end_date) }}</span>
                                    </div>
                                    <div class="col-12 col-md-4 d-flex align-items-end justify-content-center px-1 mt-2">
                                        <a class="btn btn-primary w-100"
                                            href="{{ route('student.progress', $active_class) }}">ACESSAR</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <hr>
    <div class="my-3">
        <h3 class="d-inline fs-4">Turmas passadas</h3>
        <div class="d-flex py-3">
            @forelse($tccs as $tcc)
                <div class="card student-subjects-end box-shadow m-2">
                    <div class="card-body">
                        <h3 class="card-title">{{ $tcc->subject->class }}</h3>
                        <p class="card-text w-auto @switch($tcc->situation) @case('Reprovado')text-danger"> Reprovado @break
                                @case('Aprovado')text-success"> Aprovado @break @endswitch
                        </p>
                        <p class="
                            card-text">{{ $tcc->subject->class_code }}</p>
                        <a class="text-end btn btn-success"
                            href="{{ route('student.progress', $tcc->subject->id) }}">ENTRAR</a>
                    </div>
                </div>
            @empty
                <div class="d-flex justify-content-center box-shadow py-4 px-1 w-100">
                    <h5 class="text-center my-3 px-2">NÃO HÁ HISTÓRICO DE TURMAS!</h5>
                </div>
            @endforelse
        </div>
    </div>
@endsection
