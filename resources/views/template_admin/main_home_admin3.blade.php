<!DOCTYPE html>
<html lang="en">
<head>
    <title>Área De Trabalho Do Modelador</title>
       @include('template_admin.head')
    <link href="{{ asset("css/normalize.css") }}" rel="stylesheet">
</head>
<body class="intro">
<aside id="left-panel" class="left-panel float-sm-left">
    @include('menu.menu_admin')
</aside>
<div class="row">
    @yield('content')
</div>
@include('template_admin.footer-scripts') 
</body>
</html>
