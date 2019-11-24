@extends('layout')

@section('cabecalho')
    Temporadas de {{ $serie->nome }}
@endsection

@section('conteudo')

    @foreach($temporadas as $temporada)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="/temporadas/{{ $temporada->id }}/episodios">
                Temporada {{ $temporada->numero }}
            </a>
            <scan class="badge badge-secondary">
                0 / {{ $temporada->episodios->count() }}
            </scan>
        </li>

    @endforeach()

@EndSection
