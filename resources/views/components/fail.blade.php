@if (Session::get('fail'))
    <div class="alert alert-danger text-center">
        {{ Session::get('fail') }}
    </div>
@endif
