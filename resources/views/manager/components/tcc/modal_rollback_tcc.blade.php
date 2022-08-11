<!-- Modal -->
<div class="modal fade" id="modal-rollback-tcc" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('manager.accompaniment.rollback') }}" method="post">
                <div class="modal-header">
                    <h4 class="modal-title fs-4" id="staticBackdropLabel">Devolver etapa</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    @csrf

                    <input class="d-none" id="rollback-id" type="hidden" name="id" value="{{ $tcc->id }}" required>
                    <input class="d-none" id="stage" type="hidden" name="stage" value="{{ $stage }}" required>
                    <h5 class="fs-5 text-start mb-2">Informe o motivo da devolução:</h5>
                    <div>
                        <textarea class="form-control" name="message" id="message" cols="20" rows="5"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">FECHAR</button>
                    <button class="btn btn-danger" type="submit">DEVOLVER</button>
                </div>
            </form>
        </div>
    </div>
</div>
