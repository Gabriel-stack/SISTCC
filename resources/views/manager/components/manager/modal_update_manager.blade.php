<!-- Modal -->
<div class="modal fade" id="modal-update-manager" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('manager.manager.update') }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">EDITAR PROFESSOR</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    @csrf

                    <input class="d-none" id="update-id" type="hidden" name="id" required>

                    <div class="col-12 my-2">
                        <label class="form-label">NOME</label>
                        <input class="form-control" id="update-name" type="text" name="name" required>
                    </div>

                    <div class="col-12 my-2">
                        <label class="form-label">E-MAIL</label>
                        <input class="form-control" id="update-email" type="text" name="email" required>
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

<script>
    const modalUpdate = document.getElementById('modal-update-manager');
    modalUpdate.addEventListener('shown.bs.modal', (event) => {
        let button = $(event.relatedTarget);
        let manager = button.data('manager');
        document.querySelector('#update-id').value = manager.id;
        document.querySelector('#update-name').value = manager.name;
        document.querySelector('#update-email').value = manager.email;
    });
</script>
