<!-- Modal -->
<div class="modal fade" id="modal-update-professor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('manager.professor.update') }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Editar orientador</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    @csrf

                    <input class="d-none" id="update-id" type="hidden" name="id" required>

                    <div class="col-12 my-2">
                        <label class="form-label">Nome</label>
                        <input class="form-control" id="update-name" type="text" name="name" required>
                    </div>

                    <div class="col-12 my-2">
                        <label class="form-label">E-mail</label>
                        <input class="form-control" id="update-email" type="text" name="email" required>
                    </div>

                    <div class="col-12 col-sm-6 my-2">
                        <label class="form-label">CPF</label>
                        <input class="form-control" id="update-cpf" type="text" name="cpf" required>
                    </div>

                    <div class="col-12 col-sm-6 my-2">
                        <label class="form-label">Telefone</label>
                        <input class="form-control" id="update-phone" type="text" name="phone" required>
                    </div>

                    <div class="col-12 my-2">
                        <label class="form-label">Órgão</label>
                        <input class="form-control" id="update-organ" type="text" name="organ" required>
                    </div>

                    <div class="col-12 my-2">
                        <label class="form-label">Titulação</label>
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
    const modalUpdate = document.getElementById('modal-update-professor');
    modalUpdate.addEventListener('shown.bs.modal', (event) => {
        let button = $(event.relatedTarget);
        let professor = button.data('professor');
        document.querySelector('#update-id').value = professor.id;
        document.querySelector('#update-name').value = professor.name;
        document.querySelector('#update-email').value = professor.email;
        document.querySelector('#update-organ').value = professor.organ;
        document.querySelector('#update-cpf').value = professor.cpf;
        document.querySelector('#update-phone').value = professor.phone;
        document.querySelector('#update-titration').value = professor.titration;
    });
</script>
