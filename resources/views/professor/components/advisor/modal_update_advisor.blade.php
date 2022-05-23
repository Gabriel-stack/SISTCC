<!-- Modal -->
<div class="modal fade" id="modal-update-advisor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('professor.advisor.update') }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">EDITAR ORIENTADOR</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    @csrf

                    <input class="d-none" id="update-id" type="hidden" name="id" required>

                    <div class="col-8 my-2">
                        <label class="form-label">NOME</label>
                        <input class="form-control" id="update-name" type="text" name="name" required>
                    </div>

                    <div class="col-4 my-2">
                        <label class="form-label">ÓRGÃO</label>
                        <input class="form-control" id="update-organ" type="text" name="organ" required>
                    </div>

                    <div class="col-12 my-2">
                        <label class="form-label">E-MAIL</label>
                        <input class="form-control" id="update-email" type="text" name="email" required>
                    </div>

                    <div class="col-6 my-2">
                        <label class="form-label">TELEFONE</label>
                        <input class="form-control" id="update-phone" type="text" name="phone" required>
                    </div>

                    <div class="col-6 my-2">
                        <label class="form-label">TITULAÇÃO</label>
                        <input class="form-control" id="update-titration" type="text" name="titration" required>
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
    const modalUpdate = document.getElementById('modal-update-advisor');
    modalUpdate.addEventListener('shown.bs.modal', (event) => {
        let button = $(event.relatedTarget);
        let advisor = button.data('advisor');
        document.querySelector('#update-id').value = advisor.id;
        document.querySelector('#update-name').value = advisor.name;
        document.querySelector('#update-organ').value = advisor.organ;
        document.querySelector('#update-email').value = advisor.email;
        document.querySelector('#update-phone').value = advisor.phone;
        document.querySelector('#update-titration').value = advisor.titration;
    });
</script>
