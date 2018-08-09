
{{--@extends('layouts.layout_admin_new.layouts.main')--}}

{{--@section('content')--}}
    {{--{!! csrf_field() !!}--}}
    {{--@includeIf('layouts.layout_admin_new.componentes.breadcrumb',[--}}
                      {{--'titulo' => 'Painel',--}}
                    {{--'sub_titulo' => 'Tarefas',--}}
                    {{--'rota' => 'painel'--}}
    {{--])--}}
    {{--@includeIf('layouts.layout_admin_new.componentes.botao',['tipo' => $tipo])--}}
    {{--@includeIf('layouts.layout_admin_new.componentes.tables',[--}}
                    {{--'titulos' => $titulos,--}}
                    {{--'tarefas' => $tarefas,--}}
                    {{--'rota_edicao' => 'controle_tarefas.edit',--}}
                    {{--'rota_exclusao' => 'controle_tarefas.destroy',--}}
                    {{--'nome_botao' => 'Novo',--}}
                    {{--'titulo' =>'Tarefas'--}}
    {{--])--}}
{{--@endsection--}}
