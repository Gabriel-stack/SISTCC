<div>
    @section('title', $subject->class)

    @include('components.success')
    @include('components.fail')
    @include('components.auth-validation-errors')

    <div class="my-5 py-4 row bg-white rounded-2 box-shadow justify-content-between align-items-center">
        <div class="row mx-0 align-items-center">
            <div class="col-4">
                <label for="student_search">Aluno</label>
                <input wire:model="search_name" class="form-control w-auto me-2" type="search" id="student_search"
                    name="student" placeholder="Pesquisar" aria-label="Search">
            </div>
            <div class="col-2">
                <label for="status_search">Situação</label>
                <select wire:model="select_situation" name="status" id="status_search" class="form-select w-auto">
                    <option value="">Todos</option>
                    <option value="Cursando">Cursando</option>
                    <option value="Analise">Análise</option>
                </select>
            </div>
            <div class="col-2">
                <label for="stage_search">Etapa</label>
                <select wire:model="select_stage" name="stage" id="stage_search" class="form-select w-auto">
                    <option value="">Todas</option>
                    <option value="Etapa 1">Etapa 1</option>
                    <option value="Etapa 2">Etapa 2</option>
                    <option value="Etapa 3">Etapa 3</option>
                </select>
            </div>
            <div class="col-4">
                <label for="professor_search">Orientador</label>
                <select wire:model="select_professor" name="professor" id="professor_search" class="form-select w-auto">
                    <option value="">Todos</option>
                    @forelse($professors as $professor)
                    <option value="{{ $professor->id }}">{{ $professor->name }}</option>
                    @empty
                    <option>Nenhum orientador cadastrado</option>
                    @endforelse
                </select>
            </div>
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
                    <th class="col-2">SITUAÇÃO</th>
                    <th class="col-1">ETAPA</th>
                    <th class="col-1">AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                @if ($tccs->all())
                @foreach ($tccs as $key => $tcc)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $tcc->student->name }}</td>
                    <td>{{ $tcc->student->email }}</td>
                    <td>{{ $tcc->professor->name }}</td>
                    <td>{{ $tcc->situation }}</td>
                    <td>{{$tcc->stage}}</td>
                    <td class="d-flex gap-1">
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" wire:click="tccId({{ $tcc->id }})"
                            data-bs-target="#modal-remove-student" data-student-id="{{ $tcc->id }}">
                            {{-- data-subject-id="{{ $subject->id }}"> --}}
                            <i class="bi bi-person-dash"></i>
                        </button>
                        <a class="btn btn-info" href="{{ route('manager.student.show', ['tcc' => $tcc->id]) }}">
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
                @include('manager.components.subject.modal_remove_student')
                @else
                <tr>
                    <td class="text-center" colspan="7">NENHUM ALUNO ENCONTRADO!</td>
                </tr>
                @endif
            </tbody>
        </table>
        @if (isset($filters))
        {{ $tccs->appends($filters)->links() }}
        @else
        {{ $tccs->links() }}
        @endif
    </div>
</div>