@guest
        <!DOCTYPE html>
<html lang="en">
@includeIf('layouts.home.head')
<body id="page-top">

@includeIf('layouts.home.nav')
<header class="masthead">
    <div class="container d-flex h-100 align-items-center">
        @yield('content')
    </div>
</header>

@includeIf('layouts.home.footer')
<!-- Bootstrap core JavaScript -->
@includeIf('layouts.home.script')
</body>

</html>
@endguest