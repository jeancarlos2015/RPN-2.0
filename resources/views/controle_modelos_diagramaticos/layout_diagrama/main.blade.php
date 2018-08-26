<!DOCTYPE html>
<html>
@includeIf('layouts.admin.layouts.head')
<body>
@includeIf('controle_modelos_diagramaticos.layout_diagrama.nav')
@includeIf('controle_modelos_diagramaticos.layout_diagrama.head_body')
<link  href="{{asset('css/bpmn/bpmn.css')}}" rel="stylesheet">

@yield('content')
@yield('codigo_js_bpmn')
@includeIf('layouts.admin.layouts.scripts')
</body>
</html>
