<!-- Modal -->
<div class="modal fade" id="modal-remove_charge-professor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('manager.professor.remove.charge') }}" method="post">
                <div class="modal-header">
                    <h4 class="modal-title fs-4" id="staticBackdropLabel">Remover cargo</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    @csrf

                    <input class="d-none" id="remove_charge-id" type="hidden" name="id" required>

                    <h5 class="fs-5">
                        <i class="bi bi-exclamation-triangle-fill fs-4"></i>
                        Realmente deseja remover o cargo de professor da disciplina?
                    </h5>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">FECHAR</button>
                    <button class="btn btn-danger" type="submit">REMOVER</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const modalRemove_charge = document.getElementById('modal-remove_charge-professor');
    modalRemove_charge.addEventListener('shown.bs.modal', (event) => {
        let button = $(event.relatedTarget);
        let professor = button.data('professor');
        document.querySelector('#remove_charge-id').value = professor.id;
    });
</script>
