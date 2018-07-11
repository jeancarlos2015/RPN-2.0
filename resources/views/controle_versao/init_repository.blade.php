@extends('layouts.modelagem.main_area_modelador2')


@section('content')
    {!! csrf_field() !!}
    <h3>Inicialização De Repositório</h3>
    <br>

    <a class="btn btn-primary form-control" href="{!! route('init') !!}">Inicializar Repositório</a>


@endsection