@extends('student.templates.panel')

@section('title', 'PAINEL')

@section('container')

    @include('components.success')
    @include('components.fail')
    @include('components.auth-validation-errors')


@endsection
