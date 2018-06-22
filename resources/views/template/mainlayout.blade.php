<!DOCTYPE html>

<html lang="en">

 
<head>
       @include('template.head')
     
</head>

<body>

<div class="wrapper">


    <div class="main-panel float-left">
        @include('template.menu_admin')
        <div class="card-box float-left">
            @include('menu.menu_sistema')
        </div>
        <div class="card-box float-right">
            @yield('content')
        </div>
    </div>


    @include('template.footer')
</div> 
</body>
@include('template.footer-scripts')
</html>
