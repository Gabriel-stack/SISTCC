@extends('manager.templates.panel')

@section('dashboard', 'text-success')

@section('title', 'GESTÃO DE TURMAS')

@section('container')
    @include('components.success')
    @include('components.fail')
    @include('components.auth-validation-errors')

    <div class="my-4">
        <h4 class="d-inline">Turma em Andamento</h4>
        <div class="d-flex flex-wrap py-3">
            @if (empty($active_subject))
                <h1 class="display-5 w-100 text-center">Não há nenhuma turma em vigência!</h1>
                <span class="h4 fw-light w-100 text-center">Cadastre uma turma</span>

                <div class="d-flex col">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#modal-store-subject">
                        CADASTRAR TURMA
                    </button>
                    @include('manager.components.subject.modal_store_subject')
                </div>
            @else
                <div class="card student-subjects box-shadow">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">{{ $active_subject->class }}</h5>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#modal-update-subject" data-subject="{{ $active_subject }}">
                                <i class="text-dark bi bi-pencil"></i>
                            </button>
                            @include('manager.components.subject.modal_update_subject')
                        </div>
                        <div class="d-flex justify-content-between flex-wrap mt-5">
                            <div class="d-flex flex-column align-content-start">
                                <span class="mb-1">Data de início</span>
                                <span class="px-5 py-1 bg-gray fw-bold">{{ @datebr($active_subject->start_date) }}</span>
                            </div>
                            <div class="d-flex flex-column align-content-start">
                                <span class="mb-1">Data de término</span>
                                <span class="px-5 py-1 bg-gray fw-bold">{{ @datebr($active_subject->end_date) }}</span>
                            </div>
                            <div class="d-flex flex-column align-content-start">
                                <span class="mb-1">Código da turma</span>
                                <span class="px-5 py-1 bg-gray fw-bold w-auto">{{ $active_subject->class_code }}</span>
                            </div>

                            <div class="align-self-end">
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modal-close-subject" data-subject="{{ $active_subject }}">
                                    ENCERRAR
                                </button>
                                @include('manager.components.subject.modal_close_subject')


                                <a class="btn btn-primary"
                                    href="{{ route('manager.subject', $active_subject->id) }}">ENTRAR</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <hr class="my-5">

    <div class="my-4">
        <div class="d-flex justify-content-between flex-wrap">
            <h4 class="">Turmas Finalizadas</h4>
            <form class="d-flex" role="search" action="{{ route('manager.subject.search') }}" method="get">
                <input class="form-control w-auto me-2" type="search" name="search" placeholder="Search"
                    aria-label="Search">
                <button class="btn btn-outline-dark" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>

        <div class="d-flex py-3">
            @forelse ($disabled_subjects as $key => $subject)
                <div class="card student-subjects-end box-shadow m-2">
                    <div class="card-body">
                        <div class="card-header">
                            <h5 class="card-title">{{ $subject->class }}</h5>
                        </div>
                        <div class="text-center">
                            <h5 class="card-text my-3">{{ $subject->class_code }}</h5>
                        </div>
                        <div class="text-end">
                            <a class="btn btn-primary" href="{{ route('manager.subject', $subject->id) }}">ENTRAR</a>
                        </div>
                    </div>
                </div>
            @empty
                <h5 class="text-center" colspan="6">NÃO HÁ HISTÓRICO DE TURMAS!</h5>
            @endforelse
        </div>

        @if (isset($filters))
            {{ $disabled_subjects->appends($filters)->links() }}
        @else
            {{ $disabled_subjects->links() }}
        @endif
    </div>
@endsection
