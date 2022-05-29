<!-- Modal -->
<div class="modal fade" id="modal-update-subject" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('manager.subject.update') }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">EDITAR TURMA</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    @csrf

                    <input class="d-none" id="update-id" type="hidden" name="id" required>

                    <div class="col-8 my-2">
                        <label class="form-label">TURMA</label>
                        <input class="form-control" id="update-class" type="text" name="class" required>
                    </div>

                    <div class="col-4 my-2">
                        <label class="form-label">CHAVE</label>
                        <input class="form-control" id="update-class_code" type="text" name="class_code" required>
                    </div>

                    <div class="col-6 my-2">
                        <label class="form-label">DATA DE INÍCIO</label>
                        <input class="form-control" id="update-start_date" type="date" name="start_date" required>
                    </div>

                    <div class="col-6 my-2">
                        <label class="form-label">DATA DE TÉRMINO</label>
                        <input class="form-control" id="update-end_date" type="date" name="end_date" required>
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
    const modalUpdate = document.getElementById('modal-update-subject');
    modalUpdate.addEventListener('shown.bs.modal', (event) => {
        let button = $(event.relatedTarget);
        let subject = button.data('subject');
        document.querySelector('#update-id').value = subject.id;
        document.querySelector('#update-class').value = subject.class;
        document.querySelector('#update-class_code').value = subject.class_code;
        document.querySelector('#update-start_date').value = subject.start_date;
        document.querySelector('#update-end_date').value = subject.end_date;
    });
</script>
