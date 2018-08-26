<script src="{!! asset('vendor/jquery/jquery.min.js') !!}"></script>
<script src="{!! asset('vendor/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
<script src="{!! asset('vendor/jquery-easing/jquery.easing.min.js') !!}"></script>
<script src="{!! asset('vendor/datatables/jquery.dataTables.js') !!}"></script>
<script src="{!! asset('vendor/datatables/dataTables.bootstrap4.js') !!}"></script>
<script src="{!! asset('js/sb-admin.min.js') !!}"></script>
<script src="{!! asset('js/sb-admin-datatables.min.js') !!}"></script>

@yield('codigo_js')

<script>
    $( document ).ready(function () {
        // $("#successMessage").delay(5000).slideUp(60);
        $('div.alert').delay(30000).slideUp(59);
    });
</script>

@yield('codigo_canvas_js')