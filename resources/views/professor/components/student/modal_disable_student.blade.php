<!-- Modal -->
<div class="modal fade" id="modal-disable-student" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('professor.student.disable') }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">DESATIVAR ALUNO</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    @csrf

                    <input class="d-none" id="disable-id" type="hidden" name="id" required>

                    <h5>REALMENTE DESEJA DESATIVAR O ALUNO?</h5>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">FECHAR</button>
                    <button class="btn btn-danger" type="submit">DESATIVAR</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const modaldisable = document.getElementById('modal-disable-student');
    modaldisable.addEventListener('shown.bs.modal', (event) => {
        let button = $(event.relatedTarget);
        let student = button.data('student');
        document.querySelector('#disable-id').value = student.id;
    });
</script>