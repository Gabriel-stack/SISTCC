<!-- Modal -->
<div class="modal fade" id="modal-assign_charge-professor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('manager.professor.assign.charge') }}" method="post">
                <div class="modal-header">
                    <h4 class="modal-title fs-4" id="staticBackdropLabel">Atribuir cargo</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    @csrf

                    <input class="d-none" id="assign_charge-id" type="hidden" name="id" required>

                    <h5 class="fs-5">Realmente deseja atribuir o cargo de professor da disciplina?</h5>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">FECHAR</button>
                    <button class="btn btn-danger" type="submit">ATRIBUIR</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const modalAssign_charge = document.getElementById('modal-assign_charge-professor');
    modalAssign_charge.addEventListener('shown.bs.modal', (event) => {
        let button = $(event.relatedTarget);
        let professor = button.data('professor');
        document.querySelector('#assign_charge-id').value = professor.id;
    });
</script>
