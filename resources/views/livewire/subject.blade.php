<div>
    <div class="container">
        <input class="form-control w-auto" type="text" wire:model="teste"> {{-- Teste --}}
    </div>
    <h1>{{$teste}}</h1>

    @include('components.success')
    @include('components.fail')
    @include('components.auth-validation-errors')

    <div class="my-5 py-4 row bg-white rounded-2 box-shadow justify-content-between align-items-center">
        <div class="row mx-0 align-items-center">
            <form class="col d-flex align-items-center" action="{{ route('manager.student.search') }}" method="GET">
                <div class="col-4">
                    <label for="student_search">Aluno</label>
                    <input wire:model="search_name" class="form-control w-auto me-2" type="search" id="student_search"
                        name="student" placeholder="Pesquisar" aria-label="Search">
                </div>
                <div class="col-2">
                    <label for="status_search">Status</label>
                    <select wire:model="select_situation" name="status" id="status_search" class="form-select w-auto">
                        <option>Selecione</option>
                        <option value="1">Cursando</option>
                        <option value="2">Análise</option>
                    </select>
                </div>
                <div class="col-2">
                    <label for="stage_search">Etapa</label>
                    <select wire:model="select_stage" name="stage" id="stage_search" class="form-select w-auto">
                        <option>Selecione</option>
                        <option value="1">Etapa 1</option>
                        <option value="2">Etapa 2</option>
                        <option value="3">Etapa 3</option>
                    </select>
                </div>
                <div class="col-4">
                    <label for="professor_search">Orientador</label>
                    <select wire:model="select_professor" name="professor" id="professor_search"
                        class="form-select w-auto">
                        <option>Selecione</option>
                        @forelse($professors as $professor)
                            <option value="{{ $professor->id }}">{{ $professor->name }}</option>
                        @empty
                            <option>Nenhum orientador cadastrado</option>
                        @endforelse
                    </select>
                </div>
            </form>
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
                            {{-- <td>{{$student->tccs->stage}}</td> --}}
                            <td class="d-flex gap-1">
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modal-remove-student" data-subject-id="{{ $subject->id }}"
                                    data-student-id="{{ $student->id }}">
                                    <i class="bi bi-person-dash"></i>
                                </button>
                                <a class="btn btn-info" wire:click="show({{ $student }})" href="#">
                                    {{-- href="{{ route('manager.student.show', ['student' => $student]) }}"> --}}
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    @include('manager.components.student.modal_remove_student')
                @else
                    <tr>
                        <td class="text-center" colspan="7">NENHUM ALUNO ENCONTRADO!</td>
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
</div>
