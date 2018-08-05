@extends('controle_modelos.layout_diagrama.main')

@section('content')
    <div id="canvas"></div>
    <div class="form-group">
        {{--<button onclick="openDiagram('http://projeto.test/novo_bpmn/novo.bpmn')" id="save-button"> Visualizar Modelo</button>--}}
        {{--<script>--}}
            {{--var diagramUrl = 'http://projeto.test/novo_bpmn/novo.bpmn';--}}
            {{--$.get(diagramUrl, openDiagram, 'text');--}}
        {{--</script>--}}

    </div>

@endsection