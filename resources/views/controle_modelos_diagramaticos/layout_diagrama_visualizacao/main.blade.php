<!DOCTYPE html>
<html>
@includeIf('layouts.admin.layouts.head')
@includeIf('controle_modelos_diagramaticos.layout_diagrama_visualizacao.head')
<body>
@includeIf('controle_modelos_diagramaticos.layout_diagrama.nav')
@yield('canvas')
@includeIf('controle_modelos_diagramaticos.layout_diagrama_visualizacao.scripts')
</body>
</html>