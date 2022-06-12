@extends('layouts.app')

@section('styles')
    <style>
        body {
            background-color: #f5f5f5;
        }
    </style>
@endsection

@section('content')
    <nav class="navbar navbar-dark fixed-top" style="background-color: #319470">
        <div class="container-fluid justify-content-between">
            <div style="width: 160px;">
                @include('components.application-logo')
            </div>

            <div class="dropdown-center">
                <button class="btn dropdown-toggle text-light" id="user" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle text-light fs-3"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="user" style="margin-right: 10px;">
                    <li class="dropdown-item text-center bg-secondary text-light">
                        {{ Helper::manager()->name }}
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('manager.profile') }}">
                            Perfil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="dropdown-item" href="{{ route('manager.dashboard') }}">
                            Turmas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="dropdown-item" href="{{ route('manager.professors') }}">
                            Orientadores
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('manager.logout') }}" method="post">
                            @csrf
                            <button class="dropdown-item" type="submit">Sair</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container pb-4" style="padding-top: 90px;">
        <h4 class="title">
            @yield('title')
        </h4>

        <hr class="my-4">

        <div class="d-flex justify-content-center">
            <div class="col-12 col-sm-11">
                @yield('container')

                @isset($slot)
                    {{ $slot }}
                @endisset
            </div>
        </div>
    </div>
@endsection
