<!-- Modal -->
<div class="modal fade" id="modal-close-subject" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('manager.subject.close') }}" method="post">
                <div class="modal-header">
                    <h4 class="modal-title fs-4" id="staticBackdropLabel">Encerrar turma</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    @csrf

                    <input class="d-none" id="close-id" type="hidden" name="id" required>

                    <h5 class="fs-5 text-start">
                        <i class="bi bi-exclamation-triangle-fill fs-4"></i>
                        Realmente deseja finalizar a turma?
                    </h5>
                    <p>Todos os alunos que não foram aprovados serão reprovados automaticamente!</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">FECHAR</button>
                    <button class="btn btn-danger" type="submit">ENCERRAR</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const modalClose = document.getElementById('modal-close-subject');
    modalClose.addEventListener('shown.bs.modal', (event) => {
        let button = $(event.relatedTarget);
        let subject = button.data('subject');
        document.querySelector('#close-id').value = subject.id;
    });
</script>
