{{--@guest--}}
{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--@includeIf('layouts.home.head')--}}
{{--<body id="page-top">--}}
{{--@includeIf('layouts.home.nav')--}}
{{--@includeIf('layouts.home.header')--}}
{{--@includeIf('layouts.home.footer')--}}
{{--<!-- Bootstrap core JavaScript -->--}}
{{--@includeIf('layouts.home.script')--}}


{{--</body>--}}
{{--</html>--}}
{{--@endguest--}}


        <!DOCTYPE html>
<html lang="en">

@includeIf('layouts.home.head')

<body id="page-top">

<!-- Navigation -->

@includeIf('layouts.home.nav')
<!-- Header -->
@includeIf('layouts.home.header')
@yield('content')
@includeIf('layouts.home.footer')
@includeIf('layouts.home.script')

</body>

</html>
