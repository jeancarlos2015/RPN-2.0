<script src="{!! asset('vendor/jquery/jquery.min.js') !!}"></script>
<script src="{!! asset('vendor/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
<script src="{!! asset('vendor/jquery-easing/jquery.easing.min.js') !!}"></script>
<script src="{!! asset('vendor/datatables/jquery.dataTables.js') !!}"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{!! asset('vendor/datatables/dataTables.bootstrap4.js') !!}"></script>
<script src="{!! asset('js/sb-admin.min.js') !!}"></script>
<script src="{!! asset('js/sb-admin-datatables.min.js') !!}"></script>





<script>
    $(document).ready(function () {
        // $("#successMessage").delay(5000).slideUp(60);
        $('div.alert').delay(30000).slideUp(59);
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>


<script>
    $(form).on('submit', function() {
        var $this = $(this);    // reference to the current scope
        dialog.confirm({
            message: 'Deseja Desvincular Este Usuário?',
            confirm: function() {
                $this.off('submit').submit();
            },
            cancel: function() {}
        });

        return false;
    });
</script>
{{--<!-- Page level plugin JavaScript-->--}}

{{--<!-- Page level plugin JavaScript-->--}}

{{--<!-- Custom scripts for this page-->--}}

{{--<!-- Custom scripts for this page-->--}}




<!-- Latest compiled and minified JavaScript -->

{{--<!-- (Optional) Latest compiled and minified JavaScript translation files -->--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/i18n/defaults-*.min.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>--}}
@yield('codigo_js')