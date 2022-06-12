<div>
    @section('title', $subject->class)

    @include('components.success')
    @include('components.fail')
    @include('components.auth-validation-errors')

    <div class="d-flex flex-wrap justify-content-center">
        <div class="col-12 col-sm-11 py-3">
            <div class="bg-white rounded-2 box-shadow d-flex flex-wrap justify-content-end justify-content-lg-between align-items-center mb-4 p-4">
                <div class="col-12 col-sm- col-md-6 col-lg-4 d-flex justify-content-center justify-content-lg-start my-1">
                    <div>
                        <label for="student_search">Aluno</label>
                        <input wire:model="search_name" class="form-control w-auto" id="student_search"
                            type="search" name="student" placeholder="Pesquisar" aria-label="Search">
                    </div>
                </div>
                <div class="col-6 col-sm- col-md-3 col-lg-2 d-flex justify-content-center justify-content-lg-start my-1">
                    <div>
                        <label for="status_search">Situação</label>
                        <select wire:model="select_situation" name="status" class="form-select w-auto" id="status_search">
                            <option value="">Todos</option>
                            <option value="Cursando">Cursando</option>
                            <option value="Analise">Análise</option>
                        </select>
                    </div>
                </div>
                <div class="col-6 col-sm- col-md-3 col-lg-2 d-flex justify-content-center justify-content-lg-start my-1">
                    <div>
                        <label for="stage_search">Etapa</label>
                        <select wire:model="select_stage" name="stage" class="form-select w-auto" id="stage_search">
                            <option value="">Todas</option>
                            <option value="Etapa 1">Etapa 1</option>
                            <option value="Etapa 2">Etapa 2</option>
                            <option value="Etapa 3">Etapa 3</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4 d-flex justify-content-center justify-content-lg-start my-1">
                    <div>
                        <label for="professor_search">Orientador</label>
                        <select wire:model="select_professor" name="professor" class="form-select w-auto" id="professor_search">
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
                <table class="table align-middle box-shadow p-2 mb-0 bg-white">
                    <thead class="bg-dark text-white">
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
                                    <td>{{ $tcc->professor->name ?? '-' }}</td>
                                    <td>{{ $tcc->situation }}</td>
                                    <td>{{ $tcc->stage }}</td>
                                    <td class="d-flex gap-1">
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            wire:click="tccId({{ $tcc->id }})" data-bs-target="#modal-remove-student"
                                            data-student-id="{{ $tcc->id }}">
                                            <i class="bi bi-person-dash"></i>
                                        </button>
                                        <a class="btn btn-info"
                                            href="{{ route('manager.show', ['subject' => $tcc->subject_id, 'tcc' => $tcc->id]) }}">
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
            </div>
            <div class="d-flex flex-wrap justify-content-between my-3">
                <div>
                    <a class="btn btn-secondary text-white" href="{{ route('manager.dashboard') }}">VOLTAR</a>
                </div>
                @if (isset($filters))
                    {{ $tccs->appends($filters)->links() }}
                @else
                    {{ $tccs->links() }}
                @endif
            </div>
        </div>
    </div>
</div>
