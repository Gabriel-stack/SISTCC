@extends('manager.templates.panel')

@section('title', 'Gestão de orientadores')

@section('container')
    @include('components.success')
    @include('components.fail')
    @include('components.auth-validation-errors')

    <div class="d-flex flex-wrap justify-content-center">
        <div class="col-12 col-sm-11 py-3">
            <div class="bg-white rounded-2 box-shadow d-flex flex-wrap justify-content-between mb-4 p-4">
                <form class="col-12 col-sm-8 d-flex flex-wrap justify-content-sm-between justify-content-center" role="search" action="{{ route('manager.professor.search') }}" method="get">
                    <div class="d-flex flex-wrap justify-content-center">
                        <input class="form-control w-auto my-2" type="search" name="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-dark mx-2 my-2" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>

                <div class="col-12 col-sm-4 d-flex justify-content-sm-end justify-content-center my-2">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-store-professor">
                        ADICIONAR
                    </button>
                    @include('manager.components.professor.modal_store_professor')
                </div>
            </div>

            <div class="overflow-auto">
                <table class="table bg-white">
                    <thead class="table-success">
                        <tr>
                            <th class="col-1">#</th>
                            <th class="col-2">Nome</th>
                            <th class="col-3">E-mail</th>
                            <th class="col-2">Telefone</th>
                            <th class="col-1">Titulação</th>
                            <th class="col-2">Ógão</th>
                            <th class="col-1">Ações</th>
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
                                        {{-- @if (in_array($professor->id, $table_manager->professor_id) && in_array($manager->subject->id, $subject->professor_id)) <!-- Improvisado -->
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#modal-remove_charge-professor"data-professor="{{ $professor }}"> <!-- Remover cargo -->
                                                <i class="bi bi-person-dash"></i>
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#modal-assign_charge-professor"data-professor="{{ $professor }}"> <!-- Atribuir cargo -->
                                                <i class="bi bi-person-plus"></i>
                                            </button>
                                        @endif --}}
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#modal-update-professor" data-professor="{{ $professor }}">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modal-destroy-professor" data-professor="{{ $professor }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            @include('manager.components.professor.modal_update_professor')
                            @include('manager.components.professor.modal_destroy_professor')
                            {{-- @include('manager.components.professor.modal_assign_charge_professor')
                            @include('manager.components.professor.modal_remove_charge_professor') --}}
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
                </table>
            </div>
            <div class="d-flex flex-wrap justify-content-between py-3">
                <div>
                    <a class="btn btn-secondary text-white" href="{{ route('manager.dashboard') }}">VOLTAR</a>
                </div>
                @if (isset($filters))
                    {{ $professors->appends($filters)->links() }}
                @else
                    {{ $professors->links() }}
                @endif
            </div>
        </div>
    </div>
@endsection
