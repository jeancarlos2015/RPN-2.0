<!doctype html>
<html lang="en">
@includeIf('layouts.admin.layouts.head')
@includeIf('controle_modelos_diagramaticos.layout_diagrama.nav')
<style type="text/css">
    html, body, #canvas {
        padding: 0;
        margin: 0;
        height: 100%;
    }

    h1 {
        position: absolute;
        top: 0;
        left: 0;
        padding: 10px 20px;
        margin: 0;
        z-index: 1;
        background: rgba(255, 255, 255, .8);
        border: solid 1px #CCC;
    }

    .diagram-note {
        background-color: rgba(66, 180, 21, 0.7);
        color: White;
        border-radius: 5px;
        font-family: Arial;
        font-size: 12px;
        padding: 5px;
        min-height: 16px;
        width: 50px;
        text-align: center;
    }

    @media screen and (max-width: 720px){
        html, body, #canvas {
            padding: 0;
            margin: 0;
            height: 100%;
            top: 100px;
        }
    }
</style>
<body>
@yield('canvas_visualizacao')
<script src="{!! asset('bpmn-app/dist/app.js') !!}"></script>
@includeIf('layouts.admin.layouts.scripts')
</body>
</html>