<!-- Modal -->
<div class="modal fade" id="modal-remove-student" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('manager.student.remove') }}" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">REMOVER ALUNO</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    @csrf

                    <input class="d-none" id="student-id" type="hidden" name="student_id" required>
                    <input class="d-none" id="subject-id" type="hidden" name="subject_id" required>

                    <h5>REALMENTE DESEJA REMOVER O ALUNO DA TURMA?</h5>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">FECHAR</button>
                    <button class="btn btn-danger" type="submit">REMOVER</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const modalremove = document.getElementById('modal-remove-student');
    modalremove.addEventListener('shown.bs.modal', (event) => {
        let button = $(event.relatedTarget);
        let studentId = button.data('student-id');
        let subjectId = button.data('subject-id');
        document.querySelector('#student-id').value = studentId;
        document.querySelector('#subject-id').value = subjectId;
    });
</script>
