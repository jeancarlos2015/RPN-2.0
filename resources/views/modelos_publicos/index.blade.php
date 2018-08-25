@extends('layouts.home.main')
@section('content')

    <!-- Example DataTables Card-->



        @includeIf('modelos_publicos.componentes.tabela.parte2')





@endsection


@section('codigo_css')

    <link href="{!! asset('vendor/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">
    <link href="{!! asset('vendor/font-awesome/css/font-awesome.min.css') !!}" rel="stylesheet" type="text/css">
    <link href="{!! asset('vendor/datatables/dataTables.bootstrap4.css') !!}" rel="stylesheet">
@endsection


@section('codigo_js')
    <script src="{!! asset('vendor/jquery/jquery.min.js') !!}"></script>
    <script src="{!! asset('vendor/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
    <script src="{!! asset('vendor/jquery-easing/jquery.easing.min.js') !!}"></script>
    <script src="{!! asset('vendor/datatables/jquery.dataTables.js') !!}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="{!! asset('vendor/datatables/dataTables.bootstrap4.js') !!}"></script>
    <script src="{!! asset('js/sb-admin.min.js') !!}"></script>
    <script src="{!! asset('js/sb-admin-datatables.min.js') !!}"></script>
@endsection