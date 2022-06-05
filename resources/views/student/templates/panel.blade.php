@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-dark fixed-top" style="background-color: #18B644;">
        <div class="container-fluid justify-content-end">
            <div class="dropdown-center">
                <button class="btn dropdown-toggle text-light" id="user" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="bi bi-person-circle text-light fs-4"></i>
                </button>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="user">
                    <li class="dropdown-item text-center bg-secondary text-light">{{ Auth::user()->name }}</li>
                    <li><a class="dropdown-item" href="{{ route('student.dashboard') }}">Painel</a></li>
                    <li><a class="dropdown-item" href="{{ route('student.profile') }}">Perfil</a></li>
                    <li>
                        <form action="{{ route('student.logout') }}" method="post">
                            @csrf
                            <button class="dropdown-item" type="submit">Sair</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container pb-4" style="padding-top: 80px">
        <h4 class="title">
            @yield('title')
        </h4>

        <hr class="my-5">

        @yield('container')
    </div>
@endsection
