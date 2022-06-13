@extends('student.templates.panel')

@section('title', 'Cadastro de TCC')

@section('container')
    <div class="col-12">
        @if ($tcc->stage == 'Etapa 1' && $tcc->situation == 'Devolvido')
            <div class="alert alert-danger text-center">
                <p class="fs-5">{{ $tcc->message }}</p>
            </div>
        @endif

        @include('components.fail')
        @include('components.auth-validation-errors')
    </div>

    <form class="my-4" action="{{ route('student.progress.tcc.store', $tcc->subject_id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="d-flex flex-wrap bg-gray-400 box-shadow rounded-2 px-4 py-3">
            <div class="col-12 col-sm-6">
                <div class="my-3 px-2">
                    <label for="professor" class="form-label">Orientador</label>
                    <select name="professor" id="professor" class="form-select">
                        <option>Selecione</option>
                        @forelse ($professors as $professor)
                            <option value="{{ $professor->id }}" @if (old('professor') == $professor->id) selected @endif>
                                {{ $professor->name }}</option>
                        @empty
                            <option disabled>Nenhum professor cadastrado</option>
                        @endforelse
                    </select>
                </div>
                <div class="my-3 px-2">
                    <label for="coprofessor_id" class="form-label">Co-orientador</label>
                    <select name="coprofessor_id" id="coprofessor_id" class="form-select">
                        <option disabled>Selecione</option>
                        @forelse ($professors as $professor)
                            <option value="{{ $professor->id }}" @if (old('coprofessor_id') == $professor->id) selected @endif>
                                {{ $professor->name }}</option>
                        @empty
                            <option disabled>Nenhum professor cadastrado</option>
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="my-3 px-2">
                    <label for="theme" class="form-label">Tema do TCC (em caixa alta)</label>
                    <input class="form-control" type="text" id="theme" name="theme" placeholder="Tema do TCC"
                        value="{{ old('theme') }}">
                </div>
                <div class="my-3 px-2">
                    <label for="title" class="form-label">Título do TCC (em caixa alta)</label>
                    <input class="form-control" type="text" id="title" name="title" placeholder="Título do TCC"
                        value="{{ old('title') }}">
                </div>
            </div>
            <div class="row align-items-end">
                <div class="my-3 px-2 col-12 col-sm-6 col-md-4 col-lg-4">
                    <label for="file_pretcc" class="form-label">Pré projeto defendido na disciplina pré-TCC</label>
                    <input class="form-control" type="file" name="file_pretcc" id="file_pretcc">
                </div>
                <div class="my-3 px-2 col-12 col-sm-6 col-md-4 col-lg-4">
                    <label for="term_commitment" class="form-label">Termo de Compromisso de Orientação Assinado</label>
                    <input class="form-control" type="file" name="term_commitment" id="term_commitment">
                </div>
                <div class="d-flex flex-column gap-1 my-3 px-2 col-12 col-sm-6 col-md-4 col-lg-2">
                    <label for="ethics_committee">Submetido ao comitê de ética</label>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-secondary">
                            <input value="1" name="ethics_committee" type="radio"
                                @if (old('ethics_committee') == 1) checked @endif> sim
                        </label>
                        <label class="btn btn-secondary">
                            <input value="2" name="ethics_committee" type="radio"
                                @if (old('ethics_committee') == 2) checked @endif> não
                        </label>
                    </div>
                </div>
                <div class="my-3 px-2 col-12 col-sm-6 col-md-4 col-lg-2">
                    <label for="date_claim">Data pretendida</label>
                    <input class="form-control" type="date" min="{{ date('Y-m-d', strtotime('+3 months')) }}" name="date_claim" id="date_claim"
                        value="{{ old('date_claim') }}">
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between my-3">
            <a class="btn btn-secondary" href="{{ route('student.progress', $subject_id) }}">VOLTAR</a>
            <button class="btn btn-success ms-2" type="submit">CADASTRAR</button>
        </div>
    </form>
@endsection
