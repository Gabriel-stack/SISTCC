<!-- Modal -->
<div class="modal fade" id="modal-active-professor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('professor.professor.active') }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">ATIVAR PROFESSOR</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    @csrf

                    <input class="d-none" id="active-id" type="hidden" name="id" required>

                    <h5>REALMENTE DESEJA ATIVAR O PROFESSOR?</h5>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">FECHAR</button>
                    <button class="btn btn-success" type="submit">ATIVAR</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const modalactive = document.getElementById('modal-active-professor');
    modalactive.addEventListener('shown.bs.modal', (event) => {
        let button = $(event.relatedTarget);
        let professor = button.data('professor');
        document.querySelector('#active-id').value = professor.id;
    });
</script>