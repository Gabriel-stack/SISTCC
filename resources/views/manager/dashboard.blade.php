@extends('manager.templates.panel')

@section('title', 'Gestão de turmas')

@section('container')
    <div class="col-12">
        @include('components.success')
        @include('components.fail')
        @include('components.auth-validation-errors')
    </div>

    <h4 class="d-inline fs-4">Turma em Andamento</h4>
    <div class="d-flex justify-content-center py-3">
        <div class="card col-12 col-sm-11 bg-gray-400 box-shadow rounded-2 m-2 py-2">
            <div class="card-body">
                @if (empty($active_subject))
                    <h5 class="fs-5 text-center">Não há nenhuma turma em vigência!</h5>
                    <div class="col-12 text-center mt-3">
                        <form action="{{ route('manager.subject.store') }}" method="post">
                            <div class="row text-start">
                                @csrf

                                <h5 class="fs-5 m-0">Criar turma</h5>

                                <div class="col-12 col-sm-6 col-lg-3 my-2">
                                    <label class="form-label mb-1">Turma</label>
                                    <input class="form-control" type="text" name="class" id="subject" required>
                                </div>

                                <div class="col-12 col-sm-6 col-lg-3 my-2">
                                    <label class="form-label mb-1">Código</label>
                                    <input class="form-control" type="text" name="class_code" id="class_code" required>
                                </div>

                                <div class="col-12 col-sm-6 col-lg-3 my-2">
                                    <label class="form-label mb-1">Data de início</label>
                                    <input class="form-control" type="date" name="start_date" min="{{ date('Y-m-d') }}" required>
                                </div>

                                <div class="col-12 col-sm-6 col-lg-3 my-2">
                                    <label class="form-label mb-1">Data de término</label>
                                    <input class="form-control" type="date" name="end_date" min="{{ date('Y-m-d', strtotime('+3 months')) }}" required>
                                </div>

                                <div class="text-end mt-2">
                                    <button class="btn btn-success w-auto" type="submit">CRIAR</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @else
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title fs-5 m-0">{{ $active_subject->class }}</h5>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                            data-bs-target="#modal-update-subject" data-subject="{{ $active_subject }}">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        @include('manager.components.subject.modal_update_subject')
                    </div>
                    <div class="d-flex flex-wrap justify-content-around">
                        <div class="col-12 col-sm-10 col-lg-8 col-xl-6 d-flex flex-wrap justify-content-around">
                            <div class="d-flex flex-column align-content-start mx-1 mt-3 w-auto">
                                <span class="mb-1">Código da turma</span>
                                <span class="px-3 py-1 bg-gray form-control fw-bold w-auto">{{ $active_subject->class_code }}</span>
                            </div>
                            <div class="d-flex flex-column align-content-start mx-1 mt-3">
                                <span class="mb-1">Data de início</span>
                                <span class="px-3 py-1 bg-gray form-control fw-bold">{{ @datebr($active_subject->start_date) }}</span>
                            </div>
                            <div class="d-flex flex-column align-content-start mx-1 mt-3">
                                <span class="mb-1">Data de término</span>
                                <span class="px-3 py-1 bg-gray form-control fw-bold">{{ @datebr($active_subject->end_date) }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap justify-content-center justify-content-md-end align-items-end">
                        <button type="button" class="btn btn-danger mt-3 me-1" data-bs-toggle="modal"
                            data-bs-target="#modal-close-subject" data-subject="{{ $active_subject }}">
                            ENCERRAR
                        </button>
                        @include('manager.components.subject.modal_close_subject')
                        <a class="btn btn-primary mt-3 ms-1"
                            href="{{ route('manager.subject', $active_subject->id) }}">
                            ACESSAR
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <hr class="col-12 my-4">

    <div class="d-flex flex-wrap justify-content-between align-items-center pt-3">
        <h4 class="d-inline fs-4 me-2">Turmas Finalizadas</h4>
        <form class="col d-flex justify-content-center justify-content-sm-end mt-2 mt-sm-0" role="search"
            action="{{ route('manager.subject.search') }}" method="get">
            <input class="form-control w-auto me-2" type="search" name="search" placeholder="Search"
                aria-label="Search">
            <button class="btn btn-light" type="submit">
                <i class="bi bi-search"></i>
            </button>
        </form>
    </div>

    <div class="d-flex flex-wrap justify-content-center py-3">
        @forelse ($disabled_subjects as $subject)
            <div class="col-12 col-md-6">
                <div class="card bg-gray-400 box-shadow rounded-2 m-2 py-2">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title fs-5">{{ $subject->class }}</h5>
                            <a class="btn btn-primary" href="{{ route('manager.subject', $subject->id) }}">
                                ACESSSAR
                            </a>
                        </div>
                        <div class="card-text d-flex flex-column text-center my-3">
                            <span class="mb-1 text-start text-lg-center">Código da turma</span>
                            <span class="px-3 py-1 bg-gray form-control fw-bold w-auto">{{ $subject->class_code }}</span>
                        </div>
                        <div class="d-flex flex-wrap justify-content-center mt-3">
                            <div class="col-12 col-md-6 d-flex flex-column align-content-start mt-1 px-1">
                                <span class="mb-1">Data de início</span>
                                <span class="px-3 text-center py-1 bg-gray form-control fw-bold" style="height: 38px;">
                                    {{ @datebr($subject->start_date) }}
                                </span>
                            </div>
                            <div class="col-12 col-md-6 d-flex flex-column align-content-start mt-1 px-1">
                                <span class="mb-1">Data de término</span>
                                <span class="px-3 text-center py-1 bg-gray form-control fw-bold"
                                    style="height: 38px;">{{ @datebr($subject->end_date) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 col-sm-11 card bg-gray-400 box-shadow rounded-2 py-4 px-1">
                <div class="card-body">
                    <h5 class="text-center fs-5 px-2">NÃO HÁ HISTÓRICO DE TURMAS!</h5>
                </div>
            </div>
        @endforelse
    </div>

    @if (isset($filters))
        {{ $disabled_subjects->appends($filters)->links() }}
    @else
        {{ $disabled_subjects->links() }}
    @endif

    <script>
        let subject = document.querySelector('#subject');
        let date = new Date();
        subject.addEventListener('click', function() {
            subject.value = 'TCC2 - ' + date.getFullYear() + '.' + (date.getMonth() < 6 ? '1' : '2')
        });
        let class_code = document.querySelector('#class_code');
        class_code.addEventListener('click', function() {
            class_code.value = '{{ Str::random(10) }}'
        });
    </script>
@endsection
