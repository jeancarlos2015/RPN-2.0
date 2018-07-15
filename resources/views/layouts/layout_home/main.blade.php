<!DOCTYPE html>
<html lang="en">
@includeIf('layouts.layout_home.head')
<body id="page-top">

@includeIf('layouts.layout_home.nav')


<header class="masthead">
    <div class="container d-flex h-100 align-items-center">
        @yield('content')
    </div>
</header>

@includeIf('layouts.layout_home.footer')
<!-- Bootstrap core JavaScript -->
@includeIf('layouts.layout_home.script')
</body>

</html>
