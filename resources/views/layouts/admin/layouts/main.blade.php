@auth

    @includeIf('layouts.admin.layouts.head')

    <body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <!-- Navigation-->
    @includeIf('layouts.admin.layouts.nav')

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
    @includeIf('layouts.admin.layouts.footer')
    <!-- Bootstrap core JavaScript-->
        @includeIf('layouts.admin.layouts.scripts')
    </div>
    </body>

    </html>

@endauth