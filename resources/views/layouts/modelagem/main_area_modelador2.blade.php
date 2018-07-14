<!DOCTYPE html>
<html lang="en"><head>
    <title>Área De Trabalho Do Modelador</title>
       @include('layouts.modelagem.head')
</head><body class="intro">
<aside id="left-panel" class="left-panel float-sm-left">
    @include('menu.menu_admin')
</aside>
<div id="right-panel" class="right-panel float-sm-left" style="width: 77%">
    <header id="header" class="card-box header float-sm-left">
        @include('layouts.modelagem.header')
    </header>
    <div class="content" id="js-drop-zone">
        @yield('content')
        @include('flash::message')
    </div>

</div>

@include('layouts.modelagem.footer-scripts') 
</body></html>