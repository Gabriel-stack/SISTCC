@if($errors->any())

<div class="alert alert-danger">
    <div class="fw-bold text-danger">
        {{ __('Algo deu errado') }}
    </div>

    <ul class="mt-3 list-disc list-inside small text-danger">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif