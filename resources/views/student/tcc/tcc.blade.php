@extends('student.templates.panel')

@section('title', 'CADASTRO DE TCC')

@section('container')
@include('components.success')
@include('components.fail')
@include('components.auth-validation-errors')

<form class="container" action="{{ route('student.progress.tcc.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row bg-gray-400 box-shadow">
        <div class="col-12 col-sm-6">
            <div class="my-3">
                <label for="professor" class="form-label">Orientador</label>
                <select name="professor" id="professor" class="form-select">
                    <option selected>Selecione</option>
                    @forelse ($professors as $professor)
                    <option value="{{ $professor->id }}">{{ $professor->name }}</option>
                    @empty
                    <option disabled>Nenhum professor cadastrado</option>
                    @endforelse
                </select>
            </div>
            <div class="my-3">
                <label for="co_professor" class="form-label">Co-orientador</label>
                <select name="co_professor" id="co_professor" class="form-select">
                    <option selected>Selecione</option>
                    @forelse ($professors as $professor)
                    <option value="{{ $professor->id }}">{{ $professor->name }}</option>
                    @empty
                    <option disabled>Nenhum professor cadastrado</option>
                    @endforelse
                </select>
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="my-3">
                <label for="theme" class="form-label">Tema do TCC (em caixa alta)</label>
                <input class="form-control" type="text" id="theme" name="theme" placeholder="Tema do TCC">
            </div>
            <div class="my-3">
                <label for="title" class="form-label">Título do TCC (em caixa alta)</label>
                <input class="form-control" type="text" id="title" name="title" placeholder="Título do TCC">
            </div>
        </div>
        <div class="row align-items-end">
            <div class="my-3 col-12 col-sm-6 col-md-4 col-lg-4">
                <label for="file_tcc" class="form-label">Pré projeto defendido na disciplina pré-TCC</label>
                <input class="form-control" type="file" name="file_tcc" id="file_tcc">
            </div>
            <div class="my-3 col-12 col-sm-6 col-md-4 col-lg-4">
                <label for="term_commitment" class="form-label">Termo de Compromisso de Orientação Assinado</label>
                <input class="form-control" type="file" name="term_commitment" id="term_commitment">
            </div>
            <div class="d-flex flex-column gap-1 my-3 col-12 col-sm-6 col-md-4 col-lg-2">
                <label for="ethics_committee">Submetido ao comitê de ética</label>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-secondary">
                        <input value="1" name="ethics_committee" type="radio"> sim
                    </label>
                    <label class="btn btn-secondary">
                        <input value="{{false}}" name="ethics_committee" type="radio"> não
                    </label>
                </div>
            </div>
            <div class="my-3 col-12 col-sm-6 col-md-4 col-lg-2">
                <label for="date_claim">Data pretendida</label>
                <input class="form-control" type="date" name="date_claim" id="date_claim">
            </div>
        </div>
    </div>
    <div class="my-3 text-end">
        <button class="btn btn-success" type="submit">CADASTRAR</button>
    </div>
</form>
@endsection
