@extends('student.templates.panel')

@section('title', 'Cadastro de TCC')

@section('container')
@include('components.success')
@include('components.fail')
@include('components.auth-validation-errors')

<form class="container" action="{{ route('student.progress.tcc.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row bg-gray-400 box-shadow">
        <div class="col-12 col-sm-6">
            <div class="my-3">
                <label for="advisor" class="form-label">Orientador</label>
                <select name="advisor" id="advisor" class="form-select">
                    <option selected>Selecione</option>
                    @forelse ($advisors as $advisor)
                    <option value="{{ $advisor->id }}">{{ $advisor->name }}</option>
                    @empty
                     <option disabled>Nenhum professor cadastrado</option>   
                  @endforelse
                </select>
            </div>
            <div class="my-3">
                <label for="co_advisor" class="form-label">Co-orientador</label>
                <select name="co_advisor" id="co_advisor" class="form-select">
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
        <div class="d-flex justify-content-between align-items-center flex-wrap col-12">
            <div class="d-flex flex-column gap-1 my-3">
                <label for="ethics_committee">Submetido ao comitê de ética</label>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-secondary">
                        <input value="1" name="ethics_committee" type="radio"> sim
                    </label>
                    <label class="btn btn-secondary">
                        <input value="2" name="ethics_committee" type="radio"> não
                    </label>
                </div>
            </div>
            <div class="my-3">
                <label for="file_tcc" class="form-label">Pré projeto defendido na disciplina pré-TCC</label>
                <input class="form-control" type="file" name="file_tcc" id="file_tcc">
            </div>
            <div class="my-3">
                <label for="term_commitment"  class="form-label">Termo de Compromisso de Orientação Assinado</label>
                <input class="form-control" type="file" name="term_commitment" id="term_commitment">
            </div>
            <div class="my-3">
                <label for="date_claim">Data pretendida</label>
                <input class="form-control" type="date" name="date_claim" id="date_claim">
            </div>
        </div>
    </div>
    <div class="my-3 text-end">
        <button class="btn btn-success">CADASTRAR</button>
    </div>
</div>

@endsection