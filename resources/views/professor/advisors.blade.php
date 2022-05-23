@extends('professor.templates.panel')

@section('advisor', 'active')

@section('title', 'GESTÃO DE ORIENTADORES')

@section('container')

    @include('components.success')
    @include('components.fail')
    @include('components.auth-validation-errors')

    <div class="my-5 row justify-content-between align-items-center">
        <form class="d-flex col" role="search" action="{{ route('professor.advisor.search') }}" method="get">

            <input class="form-control w-auto me-2" type="search" name="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-dark" type="submit">
                <i class="bi bi-search"></i>
            </button>
        </form>

        <div class="d-flex justify-content-end col">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-store-advisor">
                ADICIONAR
            </button>
            @include('professor.components.advisor.modal_store_advisor')
        </div>
    </div>

    <div class="overflow-auto my-5">
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
                @if ($advisors->all())
                    @foreach ($advisors as $key => $advisor)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $advisor->name }}</td>
                            <td>{{ $advisor->email }}</td>
                            <td>{{ $advisor->phone }}</td>
                            <td>{{ $advisor->titration }}</td>
                            <td>{{ $advisor->organ }}</td>
                            <td class="d-flex gap-1">
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#modal-update-advisor" data-advisor="{{ $advisor }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                @if ($advisor->active)
                                    <button type="button" class="btn" style="background-color: #fd7e14;"
                                        data-bs-toggle="modal" data-bs-target="#modal-disable-advisor"
                                        data-advisor="{{ $advisor }}">
                                        <i class="bi bi-person-dash"></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#modal-active-advisor" data-advisor="{{ $advisor }}">
                                        <i class="bi bi-person-check"></i>
                                    </button>
                                @endif
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modal-destroy-advisor"data-advisor="{{ $advisor }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    @include('professor.components.advisor.modal_update_advisor')
                    @include('professor.components.advisor.modal_destroy_advisor')
                    @include('professor.components.advisor.modal_disable_advisor')
                    @include('professor.components.advisor.modal_active_advisor')
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
                    {{ $advisors->appends($filters)->links() }}
                @else
                    {{ $advisors->links() }}
                @endif
            </tfoot>
        </table>
    </div>
@endsection
