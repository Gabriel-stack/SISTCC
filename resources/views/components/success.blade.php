@if (Session::get('success'))
    <div class="alert alert-success text-center">
        {{ Session::get('success') }}
    </div>
@endif
