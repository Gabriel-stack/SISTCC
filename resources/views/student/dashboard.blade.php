@extends('student.templates.panel')

@section('title', 'PÁGINA PRINCIPAL')

@section('container')

    @include('components.success')
    @include('components.fail')
    @include('components.auth-validation-errors')


@endsection
