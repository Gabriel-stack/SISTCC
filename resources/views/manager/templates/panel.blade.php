@extends('layouts.app')
@section('styles')
    <style>
        body {
            background-color: #f5f5f5;
        }

    </style>
@endsection

@section('content')
    <nav class="navbar navbar-dark fixed-top" style="background-color: #0e864e">
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
                    <li class="dropdown-item text-center bg-secondary text-light">{{ Helper::manager()->name }}</li>
                    <li><a class="dropdown-item" href="{{ route('manager.profile') }}">Perfil</a></li>
                    <li>
                        <form action="{{ route('manager.logout') }}" method="post">
                            @csrf
                            <button class="dropdown-item" type="submit">Sair</button>
                        </form>
                    </li>
                </ul>
            </div>
            <div class="offcanvas offcanvas-start bg-light" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header text-dark">
                    <h5 class="offcanvas-title text-center w-100" id="offcanvasNavbarLabel">SISTCC</h5>
                    <button type="button" class="btn bi bi-x-lg fs-4 text-dark" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link @yield('dashboard')" style="color: black;" aria-current="page"
                                href="{{ route('manager.dashboard') }}">
                                <i class="bi bi-house-door fs-4"></i>
                                GESTÃO DE TURMAS
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @yield('professor')" style="color: black;" href="{{ route('manager.professors') }}">
                                <i class="bi bi-person-video3 fs-4"></i>
                                GESTÃO DE ORIENTADORES
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="container pb-4" style="padding-top: 80px;">
        <h3 class="title">
            @yield('title')
        </h3>

        <hr class="my-5">

        @isset($slot)
            {{ $slot }}
        @endisset

        @yield('container')
    </div>
@endsection
