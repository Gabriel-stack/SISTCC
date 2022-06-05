@extends('student.templates.panel')

@section('title', 'Turmas')

@section('container')

    @include('components.success')
    @include('components.fail')
    @include('components.auth-validation-errors')

    <div class="my-3">
        <h3 class="d-inline fw-bold">Turmas disponíveis</h3>
        <div class="d-flex flex-column py-3">
            @if ($inside)
                <div class="card student-subjects box-shadow">
                    <div class="card-body">
                        <div class="card-header">
                            <h3 class="card-title">{{ $active_class->class }}</h3>
                        </div>
                        <p class="card-text w-auto text-warning">cursando</p>
                        <a class="text-center btn btn-success"
                            href="{{ route('student.progress', $active_class) }}">ENTRAR</a>
                    </div>
                </div>
            @else
                <div class="my-4 text-center">
                    <h1 class="display-5">Você não está cadastrado em nenhuma turma!</h1>
                    <span class="h4 fw-light">Realize seu cadastro em uma turma disponível </span>
                </div>
                <div class="flex">
                    <div class="card student-subjects box-shadow">
                        <div class="card-body">
                            <div class="card-header">
                                <h3 class="card-title">{{ $active_class->class }}</h3>
                            </div>
                            <p class="card-text">{{ $active_class->class_code }}</p>
                            <button class="btn btn-success" type="button" data-bs-toggle="modal"
                                data-bs-target="#enroll">MATRICULAR</button>
                        </div>
                    </div>

                    <div class="modal fade" id="enroll" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Entrar na turma</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('student.progress.enroll') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="subject" value="{{ $active_class->id }}">
                                        <div class="mb-3">
                                            <label for="class_code" class="col-form-label">Código da turma</label>
                                            <input type="text" class="form-control" name="class_code" id="class_code">
                                        </div>
                                        <div class="text-end">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">FECHAR</button>
                                            <button type="submit" class="btn btn-success">CADASTRAR</button>
                                        </div>
                                    </form>
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
        <h3 class="d-inline fw-bold">Turmas passadas</h3>
        <div class="d-flex py-3">
            @forelse($classes as $class)
                <div class="card student-subjects-end box-shadow m-2">
                    <div class="card-body">
                        <h3 class="card-title">{{ $class->class }}</h3>
                        <p class="card-text">{{ $class->class_code }}</p>
                        <a class="text-end btn btn-success" href="{{ route('student.progress', $class) }}">ENTRAR</a>
                    </div>
                </div>
            @empty
                <h5 class="text-center" colspan="6">NÃO HÁ HISTÓRICO DE TURMAS!</h5>
            @endforelse
        </div>
    </div>
@endsection
