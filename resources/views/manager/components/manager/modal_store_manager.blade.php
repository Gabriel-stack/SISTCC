<!-- Modal -->
<div class="modal fade" id="modal-store-manager" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('manager.manager.store') }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">CADASTRAR PROFESSOR</h5>
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

                    <div class="col-12 col-md-6 mt-3">
                        <label for="password">Senha</label>
                        <input id="password" class="form-control" type="password" name="password" required
                            autocomplete="current-password">
                    </div>

                    <div class="col-12 col-md-6 mt-3">
                        <label for="password_confirmation">Confirmar Senha</label>
                        <input id="password_confirmation" class="form-control" type="password"
                            name="password_confirmation" required>
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
