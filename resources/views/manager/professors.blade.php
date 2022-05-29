@extends('manager.templates.panel')

@section('professor', 'bg-info')

@section('title', 'GESTÃO DE ORIENTADORES')

@section('container')

    @include('components.success')
    @include('components.fail')
    @include('components.auth-validation-errors')

    <div class="my-5 py-4 row bg-white rounded-2 box-shadow justify-content-between align-items-center">
        <form class="d-flex col" role="search" action="{{ route('manager.professor.search') }}" method="get">

            <input class="form-control w-auto me-2" type="search" name="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-dark" type="submit">
                <i class="bi bi-search"></i>
            </button>
        </form>

        <div class="d-flex justify-content-end col">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-store-professor">
                ADICIONAR
            </button>
            @include('manager.components.professor.modal_store_professor')
        </div>
    </div>

    <div class="overflow-auto">
        <table class="table table-light">
            <thead class="table-success">
                <tr>
                    <th class="col-1">#</th>
                    <th class="col-2">NOME</th>
                    <th class="col-3">E-MAIL</th>
                    <th class="col-2">TELEFONE</th>
                    <th class="col-2">TITULAÇÃO</th>
                    <th class="col-1">ÓRGÃO</th>
                    <th class="col-1">AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                @if ($professors->all())
                    @foreach ($professors as $key => $professor)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $professor->name }}</td>
                            <td>{{ $professor->email }}</td>
                            <td>{{ $professor->phone }}</td>
                            <td>{{ $professor->titration }}</td>
                            <td>{{ $professor->organ }}</td>
                            <td class="d-flex gap-1">
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#modal-update-professor" data-professor="{{ $professor }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modal-destroy-professor"data-professor="{{ $professor }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    @include('manager.components.professor.modal_update_professor')
                    @include('manager.components.professor.modal_destroy_professor')
                @elseif (isset($filters))
                    <tr>
                        <td class="text-center" colspan="7">NENHUM ORIENTADOR ENCONTRADO!</td>
                    </tr>
                @else
                    <tr>
                        <td class="text-center" colspan="7">NENHUM ORIENTADOR CADASTRADO!</td>
                    </tr>
                @endif
            </tbody>
            <tfoot>
                @if (isset($filters))
                    {{ $professors->appends($filters)->links() }}
                @else
                    {{ $professors->links() }}
                @endif
            </tfoot>
        </table>
    </div>
@endsection
