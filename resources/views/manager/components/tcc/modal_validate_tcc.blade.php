<!-- Modal -->
<div class="modal fade" id="modal-validate-tcc" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('manager.accompaniment.validate') }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">VALIDAR ETAPA</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    @csrf

                    <input class="d-none" id="validate-id" type="hidden" name="id" required>

                    <h5>REALMENTE DESEJA VALIDAR A ETAPA?</h5>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">FECHAR</button>
                    <button class="btn btn-danger" type="submit">VALIDAR</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const modalValidate = document.getElementById('modal-validate-tcc');
    modalValidate.addEventListener('shown.bs.modal', (event) => {
        let button = $(event.relatedTarget);
        let tcc = button.data('tcc');
        document.querySelector('#validate-id').value = tcc.id;
    });
</script>
