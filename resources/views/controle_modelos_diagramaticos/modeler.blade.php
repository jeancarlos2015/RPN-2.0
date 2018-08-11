@extends('controle_modelos_diagramaticos.layout_diagrama.main')

@section('content')
    <div id="canvas"></div>


    <div class="form-group">
        <button onclick="exportDiagram('{!! $modelo->codmodelodiagramatico !!}')" id="save-button"> Salvar Modelo</button>
    </div>

@endsection