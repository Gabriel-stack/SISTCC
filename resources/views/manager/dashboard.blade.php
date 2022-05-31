@extends('manager.templates.panel')

@section('dashboard', 'text-success')

@section('title', 'GESTÃO DE TURMAS')

@section('container')

    @include('components.success')
    @include('components.fail')
    @include('components.auth-validation-errors')

    <div class="my-5 py-4 row bg-white rounded-2 box-shadow justify-content-between align-items-center">
        <form class="d-flex col" role="search" action="{{ route('manager.subject.search') }}" method="get">

            <input class="form-control w-auto me-2" type="search" name="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-dark" type="submit">
                <i class="bi bi-search"></i>
            </button>
        </form>

        <div class="d-flex justify-content-end col">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-store-subject">
                ADICIONAR
            </button>
            @include('manager.components.subject.modal_store_subject')
        </div>
    </div>

    <div class="my-4">
        <h3 class="d-inline fw-bold">Turma em Andamento</h3>
        <div class="d-flex flex-wrap py-3">
            @if (empty($active_subject))
                <h1 class="display-5 w-100 text-center">Não há nenhuma turma em vigência!</h1>
                <span class="h4 fw-light w-100 text-center">Cadastre uma turma</span>
            @else
                <div class="card student-subjects box-shadow">
                    <div class="card-body">
                        <div class="card-header">
                            <h3 class="card-title">{{ $active_subject->class }}</h3>
                        </div>
                        <p class="card-text my-2 text-success">Em Andamento</p>
                        <div class="text-center">
                            <h3 class="card-text my-3">{{ $active_subject->class_code }}</h3>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#modal-close-subject" data-subject="{{ $active_subject }}">
                                ENCERRAR
                            </button>
                            @include('manager.components.subject.modal_close_subject')
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#modal-update-subject" data-subject="{{ $active_subject }}">
                                {{-- <i class="bi bi-pencil"></i> --}}
                                EDITAR
                            </button>
                            @include('manager.components.subject.modal_update_subject')
                            <a class="btn btn-primary" href="{{ route('manager.subject', $active_subject->id)  }}">ENTRAR</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <hr class="my-5">

    <div class="my-4">
        <h3 class="d-inline fw-bold">Turmas Finalizadas</h3>
        <div class="d-flex py-3">
            @forelse ($disabled_subjects as $key => $subject)
                <div class="card student-subjects box-shadow">
                    <div class="card-body">
                        <div class="card-header">
                            <h3 class="card-title">{{ $subject->class }}</h3>
                        </div>
                        <p class="card-text my-2 text-danger">Finalizada</p>
                        <div class="text-center">
                            <h3 class="card-text my-3">{{ $subject->class_code }}</h3>
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
