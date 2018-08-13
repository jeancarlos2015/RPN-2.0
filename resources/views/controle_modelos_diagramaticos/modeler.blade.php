@extends('controle_modelos_diagramaticos.layout_diagrama.main')

@section('content')
    <div id="canvas"></div>
    <div class="form-group">

        <button onclick="exportDiagram('{!! $modelo->codmodelodiagramatico !!}')" id="save-button"> Salvar Modelo</button>
    </div>

@endsection

@section('modo')
    <li class="nav-item">
        <a class="nav-link" title="Você está no modo de Edição de modelo. As alterações que você fizer aqui deverão ser salvas.">
            <p class="fa fa-edit"> Modo De Edição Do Modelo </p>
            <span class="sr-only"></span>
        </a>
    </li>
@endsection