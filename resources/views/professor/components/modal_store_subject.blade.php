<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Launch static backdrop modal
</button> --}}

<!-- Modal -->
<div class="modal fade" id="modal-store-subject" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('professor.subject.store') }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">CRIAR TURMA</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    @csrf
                    <div class="col-8 my-2">
                        <label class="form-label">TURMA</label>
                        <input class="form-control" type="text" name="semester" required>
                    </div>

                    <div class="col-4 my-2">
                        <label class="form-label">CHAVE</label>
                        <input class="form-control" type="text" name="key" required>
                    </div>

                    <div class="col-6 my-2">
                        <label class="form-label">DATA DE INÍCIO</label>
                        <input class="form-control" type="date" name="start_date" required>
                    </div>

                    <div class="col-6 my-2">
                        <label class="form-label">DATA DE TÉRMINO</label>
                        <input class="form-control" type="date" name="end_date" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">FECHAR</button>
                    <button class="btn btn-success" type="submit">SALVAR</button>
                </div>
            </form>
        </div>
    </div>
</div>