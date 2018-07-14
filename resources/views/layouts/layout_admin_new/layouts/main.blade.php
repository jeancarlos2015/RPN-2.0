@includeIf('layouts.layout_admin_new.layouts.head')

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<!-- Navigation-->
@includeIf('layouts.layout_admin_new.layouts.nav')

<div class="content-wrapper">
    <div class="container-fluid">

        @yield('content')
        @include('flash::message')
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
   @includeIf('layouts.layout_admin_new.layouts.footer')
    <!-- Bootstrap core JavaScript-->
    @includeIf('layouts.layout_admin_new.layouts.scripts')
</div>
</body>

</html>
