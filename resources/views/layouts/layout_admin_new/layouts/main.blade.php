@includeIf('layouts.layout_admin_new.layouts.head')

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<!-- Navigation-->
@includeIf('layouts.layout_admin_new.layouts.nav')

<div class="content-wrapper">
    <div class="container-fluid">

        @yield('content')
        @include('flash::message')
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <!-- /.container-fluid-->

    <!-- /.content-wrapper-->
   @includeIf('layouts.layout_admin_new.layouts.footer')
    <!-- Bootstrap core JavaScript-->
    @includeIf('layouts.layout_admin_new.layouts.scripts')
</div>
</body>

</html>
