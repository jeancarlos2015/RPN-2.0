<!DOCTYPE html>
<html>
@includeIf('layouts.layout_admin_new.layouts.head')
<body>
@includeIf('controle_modelos_diagramaticos.layout_diagrama.nav')
@includeIf('controle_modelos_diagramaticos.layout_diagrama.head_body')

@yield('content')

@includeIf('controle_modelos_diagramaticos.layout_diagrama.script')
</body>
</html>
