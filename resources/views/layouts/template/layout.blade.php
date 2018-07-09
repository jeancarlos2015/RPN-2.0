<!DOCTYPE html>
<html lang="en">
<head>
       @include('layouts.template.head')
</head>
<body>
<div class="wrapper">
    <div class="main-panel float-left">
        @include('layouts.template.menu')
        <div class="card-box float-left">
            @include('menu.menu_admin')
        </div>
        <div class="card-box float-right">
            @yield('content')
        </div>
    </div>
    @include('layouts.template.footer')
</div>
</body>
@include('layouts.template.footer-scripts')
</html>
