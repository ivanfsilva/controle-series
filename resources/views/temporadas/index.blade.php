@extends('layout')

@section('cabecalho')
    Temporadas de {{ $serie->nome }}
@endsection

@section('conteudo')

    @foreach($temporadas as $temporada)
        <li class="list-group-item">Temporada {{ $temporada->numero }}</li>
    @endforeach()

@EndSection
