<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    @auth
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @endauth
    <title>RPN - Repositório de Processos de Negócios</title>

{{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">--}}

<!-- Bootstrap core CSS-->
    <link href="{!! asset('vendor/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">

    <link href="{!! asset('vendor/font-awesome/css/font-awesome.min.css') !!}" rel="stylesheet" type="text/css">
    <!-- Custom fonts for this template_basico-->
    <!-- Page level plugin CSS-->
    <link href="{!! asset('vendor/datatables/dataTables.bootstrap4.css') !!}" rel="stylesheet">
    <!-- Custom styles for this template_basico-->
    <link href="{!! asset('css/sb-admin.css') !!}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/css-toggle-switch/latest/toggle-switch.css"/>

</head>
