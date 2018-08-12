@extends('controle_modelos_diagramaticos.layout_diagrama.main')

@section('content')

<div id="canvas"></div>
@endsection

@section('modo')
    <li class="nav-item">
        <a class="nav-link" title="Você está no modo de visualização de modelo. As alterações que você fizer aqui não poderão ser salvas.">
            <p class="fa fa-eye"> Modo De Visualização Do Modelo</p>
            <span class="sr-only"></span>
        </a>
    </li>
@endsection