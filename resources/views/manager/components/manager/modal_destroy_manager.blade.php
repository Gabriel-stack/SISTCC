<!-- Modal -->
<div class="modal fade" id="modal-destroy-manager" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('manager.manager.destroy') }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">EXCLUIR PROFESSOR</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    @csrf

                    <input class="d-none" id="destroy-id" type="hidden" name="id" required>

                    <h5>REALMENTE DESEJA EXCLUIR O PROFESSOR?</h5>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">FECHAR</button>
                    <button class="btn btn-danger" type="submit">EXCLUIR</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const modaldestroy = document.getElementById('modal-destroy-manager');
    modaldestroy.addEventListener('shown.bs.modal', (event) => {
        let button = $(event.relatedTarget);
        let manager = button.data('manager');
        document.querySelector('#destroy-id').value = manager.id;
    });
</script>
