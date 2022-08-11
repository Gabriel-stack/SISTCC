<!-- Modal -->
<div class="modal fade" id="modal-cancel-disapproval-tcc" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('manager.accompaniment.cancel_disapproval') }}" method="post">
                <div class="modal-header">
                    <h4 class="modal-title fs-4" id="staticBackdropLabel">Cancelar reprovação</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    @csrf

                    <input class="d-none" id="cancel-disapproval-id" type="hidden" name="id" value="{{ $tcc->id }}" required>

                    <h5 class="fs-5">
                        <i class="bi bi-exclamation-triangle-fill fs-4"></i>
                        Realmente deseja cancelar a reprovação do aluno?
                    </h5>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">FECHAR</button>
                    <button class="btn btn-danger" type="submit">CONFIRMAR</button>
                </div>
            </form>
        </div>
    </div>
</div>
