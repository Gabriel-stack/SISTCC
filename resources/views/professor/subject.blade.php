@extends('layouts.app');

@section('content')

@if(isset($filters))
    {{ $dataIngredients->appends($filters)->links() }}
@else
    {{ $dataIngredients->links() }}
@endif
@endsection
