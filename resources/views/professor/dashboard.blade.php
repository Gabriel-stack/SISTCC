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
                    <th class="col-1">STATUS</th>
                    <th class="col-1">SITUAÇÃO</th>
                    <th class="col-2">AÇÕES</th>
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
                                @if ($student->active)
                                    <button type="button" class="btn" style="background-color: #fd7e14;" data-bs-toggle="modal"
                                        data-bs-target="#modal-disable-student" data-student="{{ $student }}">
                                        <i class="bi bi-person-dash"></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#modal-active-student" data-student="{{ $student }}">
                                        <i class="bi bi-person-check"></i>
                                    </button>
                                @endif
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modal-destroy-student" data-student="{{ $student }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                                    {{-- <input class="d-none" type="hidden" name="id" value="{{ $student->id }}"> --}}

                                    <button class="btn btn-info" type="submit">
                                        <a href="{{route('professor.student.show', ['student' => $student])}}"><i class="bi bi-eye"></i></a>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @include('professor.components.student.modal_destroy_student')
                    @include('professor.components.student.modal_disable_student')
                    @include('professor.components.student.modal_active_student')
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
