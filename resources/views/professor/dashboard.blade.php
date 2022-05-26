@extends('professor.templates.panel')

@section('dashboard', 'active')

@section('title', 'GESTÃO DE ALUNOS')

@section('container')

@include('components.success')
@include('components.fail')
@include('components.auth-validation-errors')

<div class="my-5 row justify-content-between align-items-center">
    <form class="d-flex col" role="search" action="{{ route('professor.student.search') }}" method="get">
        <input class="form-control w-auto me-2" type="search" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-dark" type="submit">
            <i class="bi bi-search"></i>
        </button>
    </form>
</div>

<div class="overflow-auto my-5">
    <table class="table table-light">
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
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-remove-student" 
                        data-subject-id="{{ Auth::guard('professor')->user()->subject_id }}" data-student-id="{{ $student->id }}">
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
        <tfoot>
            @if (isset($filters))
            {{ $students->appends($filters)->links() }}
            @else
            {{ $students->links() }}
            @endif
        </tfoot>
    </table>
</div>
@endsection
