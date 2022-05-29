<!-- Modal -->
<div class="modal fade" id="modal-destroy-subject" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('manager.subject.destroy') }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">EXCLUIR TURMA</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    @csrf

                    <input class="d-none" id="destroy-id" type="hidden" name="id" required>

                    <h5>REALMENTE DESEJA EXCLUIR A TURMA?</h5>
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
    const modalDestroy = document.getElementById('modal-destroy-subject');
    modalDestroy.addEventListener('shown.bs.modal', (event) => {
        let button = $(event.relatedTarget);
        let subject = button.data('subject');
        document.querySelector('#destroy-id').value = subject.id;
    });
</script>
