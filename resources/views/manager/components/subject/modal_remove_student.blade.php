<!-- Modal -->
<div class="modal fade" id="modal-remove-student" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true" wire:ignore>
    <div class="modal-dialog">
        <div class="modal-content">
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
                <button wire:click="remove" class="btn btn-danger" id="remove">REMOVER</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- @section('scripts') --}}
    <script>
        $('#remove').on('click', function(event) {
            $('#modal-remove-student').modal('hide');
        });
    </script>
{{-- @endsection --}}
