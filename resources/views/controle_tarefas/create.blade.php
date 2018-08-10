
{{--@extends('layouts.layout_admin_new.layouts.main')--}}

{{--@section('content')--}}
    {{--{!! csrf_field() !!}--}}
    {{--@includeIf('layouts.layout_admin_new.componentes.breadcrumb',[--}}
                      {{--'titulo' => 'Painel',--}}
                    {{--'sub_titulo' => 'Tarefas',--}}
                    {{--'rota' => 'todas_tarefas'--}}
    {{--])--}}

    {{--<form action="{!! route('controle_regras.store') !!}" method="post">--}}
        {{--@includeIf('controle_tarefas.form',--}}
        {{--[--}}
        {{--'acao' => 'ObjetoDeFluxo',--}}
        {{--'dados' => $dados,--}}
        {{--'MAX' => 2,--}}
        {{--'codprojeto' => $projeto->codprojeto,--}}
        {{--'codmodelo' => $modelo->codmodelo,--}}
        {{--'codrepositorio' => $repositorio->codrepositorio--}}
        {{--]--}}
        {{--)--}}
    {{--</form>--}}
{{--@endsection--}}
