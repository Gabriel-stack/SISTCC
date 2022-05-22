@extends('layouts.app')

@section('content')
<nav class="navbar navbar-dark bg-success fixed-top">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="dropdown-center">
            <button class="btn dropdown-toggle" type="button" id="user" data-bs-toggle="dropdown" aria-expanded="false">
                <i style="font-size: 24px; color: rgba(255, 255, 255, 0.897)" class="bi bi-person-circle"></i>
            </button>

            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="user">
                <li class="dropdown-item text-center bg-secondary" style="color: white;">{{
                    Auth::guard('professor')->user()->name }}</li>
                <li><a class="dropdown-item" href="{{ route('professor.profile') }}">Perfil</a></li>
                <li>
                    <form action="{{ route('professor.logout') }}" method="post">
                        @csrf
                        <button class="dropdown-item" type="submit">Sair</button>
                    </form>
                </li>
            </ul>
        </div>
        <div class="offcanvas offcanvas-start bg-success" tabindex="-1" id="offcanvasNavbar"
            aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title text-center w-100" id="offcanvasNavbarLabel">SISTCC</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link @yield('dashboard')" aria-current="page"
                            href="{{ route('professor.dashboard') }}">Painel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('subject')" href="{{ route('professor.subject') }}">Turmas</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<div class="container" style="margin-top: 80px">
    <h4 class="title">
        @yield('title')
    </h4>

    @yield('container')
</div>
@endsection