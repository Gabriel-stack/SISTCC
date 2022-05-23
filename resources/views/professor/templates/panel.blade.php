@extends('layouts.app')

@section('content')
    <nav class="navbar navbar-dark bg-success fixed-top">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="dropdown-center">
                <button class="btn dropdown-toggle text-light" id="user" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="bi bi-person-circle text-light fs-4"></i>
                </button>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="user">
                    <li class="dropdown-item text-center bg-secondary text-light">
                        {{ Auth::guard('professor')->user()->name }}</li>
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
                <div class="offcanvas-header text-light">
                    <h5 class="offcanvas-title text-center w-100" id="offcanvasNavbarLabel">SISTCC</h5>
                    <button type="button" class="btn bi bi-x-lg fs-4 text-light" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link @yield('dashboard')" aria-current="page"
                                href="{{ route('professor.dashboard') }}">
                                <i class="bi bi-house-door fs-4"></i>
                                GESTÃO DE ALUNOS
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @yield('subject')" href="{{ route('professor.subjects') }}">
                                <i class="bi bi-bookmarks fs-4"></i>
                                GESTÃO DE TURMAS
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @yield('advisor')" href="{{ route('professor.advisors') }}">
                                <i class="bi bi-person-video3 fs-4"></i>
                                GESTÃO DE ORIENTADORES
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @yield('professor')" href="{{ route('professor.professors') }}">
                                <i class="bi bi-person-workspace fs-4"></i>
                                GESTÃO DE PROFESSORES
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="container" style="padding-top: 80px">
        <h4 class="title">
            @yield('title')
        </h4>

        @yield('container')
    </div>
@endsection
