@extends('layouts.app')

@section('content')
    <div>
        <p>{{ Auth::guard('professor')->user()->name }}</p>
        <p>{{ Auth::guard('professor')->user()->email }}</p>
    </div>

    <form action="{{ route('professor.logout') }}" method="post">
        @csrf
        <button class="btn btn-danger" type="submit">Sair</button>
    </form>
@endsection
