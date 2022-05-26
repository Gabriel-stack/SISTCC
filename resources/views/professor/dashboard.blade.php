@extends('professor.templates.panel')

@section('dashboard', 'active')

@section('title', 'GESTÃO DE ALUNOS')

@section('container')

@include('components.success')
@include('components.fail')
@include('components.auth-validation-errors')

<div class="my-5 py-4 row bg-white rounded-2 box-shadow justify-content-between align-items-center">
    <form class="d-flex justify-content-between flex-wrap col-3" role="search" action="{{ route('professor.student.search') }}"
        method="GET">
        <div class="d-block">
            <label for="student_search">Aluno</label>
            <input class="form-control w-auto me-2" type="search" id="student_search" name="student_search"
                placeholder="Pesquisar" aria-label="Search">
        </div>
        <div class="align-self-end">
            <button class="btn btn-outline-dark" type="submit">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </form>
    <div class="col-3">
        <label for="status_search">Status</label>
        <select name="status_search" id="status_search" class="form-select">
            <option value="">1</option>
            <option value="1">2</option>
            <option value="0">3</option>
        </select>
    </div>
    <div class="col-3">
        <label for="situation_search">Situação</label>
        <select name="situation_search" id="situation_search" class="form-select">
            <option value="">1</option>
            <option value="1">2</option>
            <option value="0">3</option>
        </select>
    </div>
    <div class="col-3">
        <label for="advisor_search"></label>
        <select name="advisor_search" id="advisor_search" class="form-select">
            <option value="">1</option>
            <option value="1">2</option>
            <option value="0">3</option>
        </select>
    </div>
</div>

<div class="overflow-auto mt-4">
    <table class="table bg-white box-shadow p-2">
        <thead class="table-success">
            <tr>
                <th class="col-1">#</th>
                <th class="col-2">NOME</th>
                <th class="col-3">E-MAIL</th>
                <th class="col-2">ORIENTADOR</th>
                <th class="col-2">STATUS</th>
                <th class="col-1">ETAPA</th>
                <th class="col-1">AÇÕES</th>
            </tr>
        </thead>
        <tbody>
            @if ($students->all())
            @foreach ($students as $key => $student)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td></td>
                <td>{{ $student->status }}</td>
                <td></td>
                <td class="d-flex gap-1">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#modal-remove-student"
                        data-subject-id="{{ Auth::guard('professor')->user()->subject_id }}"
                        data-student-id="{{ $student->id }}">
                        <i class="bi bi-person-dash"></i>
                    </button>
                    <a class="btn btn-info" href="{{route('professor.student.show', ['student' => $student])}}">
                        <i class="bi bi-eye"></i>
                    </a>
                </td>
            </tr>
            @endforeach
            @include('professor.components.student.modal_remove_student')
            @elseif (isset($filters))
            <tr>
                <td class="text-center" colspan="7">NENHUM ALUNO ENCONTRADO!</td>
            </tr>
            @else
            <tr>
                <td class="text-center" colspan="7">NENHUM ALUNO CADASTRADO!</td>
            </tr>
            @endif
        </tbody>
    </table>
    @if (isset($filters))
    {{ $students->appends($filters)->links() }}
    @else
    {{ $students->links() }}
    @endif
</div>
@endsection