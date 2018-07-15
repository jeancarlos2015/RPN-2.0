<!DOCTYPE html>
<html lang="en">
<head>
       @include('layouts.template_basico.head')
</head>
<body>
<div class="wrapper">
    <div class="main-panel float-left">
        @include('layouts.template_basico.menu')
        <div class="card-box float-left">
            @include('menu.menu_admin')
        </div>
        <div class="card-box float-right">
            @yield('content')
        </div>
    </div>
    @include('layouts.template_basico.footer')
</div>
</body>
@include('layouts.template_basico.footer-scripts')
</html>
