<!-- Modal -->
<div class="modal fade" id="modal-disapprove-tcc" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('manager.accompaniment.disapprove') }}" method="post">
                <div class="modal-header">
                    <h4 class="modal-title fs-4" id="staticBackdropLabel">Reprovar aluno</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    @csrf

                    <input class="d-none" id="disapprove-id" type="hidden" name="id" value="{{ $tcc->id }}" required>

                    <h5 class="fs-5">
                        <i class="bi bi-exclamation-triangle-fill text-warning fs-4"></i>
                        Realmente deseja reprovar o aluno?
                    </h5>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">FECHAR</button>
                    <button class="btn btn-danger" type="submit">REPROVAR</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- <script>
    const modalDisapprove = document.getElementById('modal-disapprove-tcc');
    modalDisapprove.addEventListener('shown.bs.modal', (event) => {
        let button = $(event.relatedTarget);
        let tcc = button.data('tcc');
        document.querySelector('#disapprove-id').value = tcc.id;
    });
</script> --}}
