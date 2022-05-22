@extends('professor.templates.panel')

@section('subject', 'active')

@section('title', 'GESTÃO DE TURMAS')

@section('container')

@include('components.success')
@include('components.fail')
@include('components.auth-validation-errors')

<div class="my-5 row justify-content-between align-items-center">
    <form class="d-flex col" role="search" action="{{ route('professor.subject.search') }}" method="get">
    
        <input class="form-control w-auto me-2" type="search" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-dark" type="submit">
            <i class="bi bi-search"></i>
        </button>
    </form>

    <div class="d-flex justify-content-end col">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal"
            data-bs-target="#modal-store-subject">
            ADICIONAR
        </button>
        @include('professor.components.modal_store_subject')
    </div>
</div>

<table class="table table-light my-5">
    <thead class="table-dark">
        <tr>
            <th class="col-1">#</th>
            <th class="col-2">TURMA</th>
            <th class="col-2">CHAVE</th>
            <th class="col-3">DATA DE INÍCIO</th>
            <th class="col-3">DATA DE TÉRMINO</th>
            <th class="col-1">AÇÕES</th>
        </tr>
    </thead>
    <tbody>
        @if ($subjects->all())
        @foreach ($subjects as $key => $subject)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $subject->semester }}</td>
            <td>{{ $subject->key }}</td>
            <td>{{ date('d/m/Y', strtotime($subject->start_date)) }}</td>
            <td>{{ date('d/m/Y', strtotime($subject->end_date)) }}</td>
            <td class="d-flex gap-1">
                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                    data-bs-target="#modal-update-subject" data-subject="{{ $subject }}">
                    <i class="bi bi-pencil"></i>
                </button>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#modal-destroy-subject" data-subject="{{ $subject }}">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        </tr>
        @endforeach
        @include('professor.components.modal_update_subject')
        @include('professor.components.modal_destroy_subject')
        @elseif (isset($filters))
        <tr>
            <td class="text-center" colspan="6">NENHUMA TURMA ENCONTRADA!</td>
        </tr>
        @else
        <tr>
            <td class="text-center" colspan="6">NENHUMA TURMA CADASTRADA!</td>
        </tr>
        @endif
    </tbody>
    <tfoot>
        @if (isset($filters))
        {{ $subjects->appends($filters)->links() }}
        @else
        {{ $subjects->links() }}
        @endif
    </tfoot>
</table>
@endsection