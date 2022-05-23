<!-- Modal -->
<div class="modal fade" id="modal-destroy-advisor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('professor.advisor.destroy') }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">EXCLUIR ORIENTADOR</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    @csrf

                    <input class="d-none" id="destroy-id" type="hidden" name="id" required>

                    <h5>REALMENTE DESEJA EXCLUIR O ORIENTADOR?</h5>
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
    const modaldestroy = document.getElementById('modal-destroy-advisor');
    modaldestroy.addEventListener('shown.bs.modal', (event) => {
        let button = $(event.relatedTarget);
        let advisor = button.data('advisor');
        document.querySelector('#destroy-id').value = advisor.id;
    });
</script>
