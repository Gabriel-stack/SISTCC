@extends('layouts.app')

@section('content')
    <div>
        <p>{{ Auth::user()->name }}</p>
        <p>{{ Auth::user()->email }}</p>
    </div>

    <form action="{{ route('student.logout') }}" method="post">
        @csrf
        <button class="btn btn-danger" type="submit">Sair</button>
    </form>
@endsection
