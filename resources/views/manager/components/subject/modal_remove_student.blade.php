<!-- Modal -->
<div class="modal fade" id="modal-remove-student" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true" wire:ignore>
    <div class="modal-dialog">
        <div class="modal-content">
            {{-- <form wire:submit.prevent.default="remove" method="post"> --}}
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">REMOVER ALUNO</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    @csrf

                    <h5>REALMENTE DESEJA REMOVER O ALUNO DA TURMA?</h5>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">FECHAR</button>
                    {{-- <button class="btn btn-danger" type="submit">REMOVER</button> --}}
                    <button wire:click="remove" class="btn btn-danger">REMOVER</button>
                </div>
            {{-- </form> --}}
        </div>
    </div>
</div>

{{-- <script>
    $('#modal-remove-student').on('submit', function(event) {
        $(this).modal('hide');
    });
</script> --}}
