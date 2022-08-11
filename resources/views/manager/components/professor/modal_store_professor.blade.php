<!-- Modal -->
<div class="modal fade" id="modal-store-professor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('manager.professor.store') }}" method="post">
                <div class="modal-header">
                    <h4 class="modal-title fs-4" id="staticBackdropLabel">Cadastrar orientador</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    @csrf

                    <div class="col-12 my-2">
                        <label class="form-label">Nome</label>
                        <input class="form-control" type="text" name="name" required>
                    </div>

                    <div class="col-12 my-2">
                        <label class="form-label">E-mail</label>
                        <input class="form-control" type="text" name="email" required>
                    </div>

                    <div class="col-12 col-sm-6 my-2">
                        <label class="form-label">CPF</label>
                        <input class="form-control" type="text" name="cpf" required>
                    </div>

                    <div class="col-12 col-sm-6 my-2">
                        <label class="form-label">Telefone</label>
                        <input class="form-control" type="text" name="phone" required>
                    </div>

                    <div class="col-12 my-2">
                        <label class="form-label">Órgão</label>
                        <input class="form-control" type="text" name="organ" required>
                    </div>

                    <div class="col-12 my-2">
                        <label class="form-label">Titulação</label>
                        <input class="form-control" type="text" name="titration" required>
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
