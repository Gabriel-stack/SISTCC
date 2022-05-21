@extends('professor.components.panel')

@section('subject', 'active')

@section('title', 'GESTÃO DE TURMAS')

@section('action')
    <div class="my-5 row justify-content-between align-items-center">
        <form class="d-flex col" role="search" action="{{ route('professor.subject.search') }}" method="get">
            @csrf
            <input class="form-control w-auto me-2" type="search" name="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-dark" type="submit">
                <i class="bi bi-search"></i>
            </button>
        </form>

        <div class="d-flex justify-content-end col">
            <button class="btn btn-success" id="add">ADICIONAR</button>
        </div>
    </div>
@endsection

@section('container')
    @include('components.fail')
    @include('components.success')

    <table class="table table-light">
        <thead class="table-dark">
            <tr>
                <th class="col-1">#</th>
                <th class="col-2">TURMA</th>
                <th class="col-2">CHAVE</th>
                <th class="col-3">DATA DE INÍCIO</th>
                <th class="col-3">DATA DE TÉRMINO</th>
                <th class="col-1">AÇÕES</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($subjects as $key => $subject)
                <tr>
                    <td>{{ $key }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endforeach --}}
        </tbody>
        <tfoot>
            {{-- @if (isset($filters))
                {{ $subjects->appends($filters)->links() }}
            @else
                {{ $subjects->links() }}
            @endif --}}
        </tfoot>
    </table>
@endsection
