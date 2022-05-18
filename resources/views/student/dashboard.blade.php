@extends('layouts.app')

@section('content')
<div>
    <p>{{ Auth::user()->name }}</p>
    <p>{{ Auth::user()->email }}</p>
</div>
@endsection
