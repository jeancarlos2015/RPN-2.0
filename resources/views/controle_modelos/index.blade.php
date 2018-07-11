{{--@extends('layouts.modelagem.main_area_modelador2')--}}


{{--@section('content')--}}
    {{--{!! csrf_field() !!}--}}

    {{--@includeIf('componentes.dados_exibicao')--}}
    {{--<h4>Controle De Modelos</h4>--}}

    {{--<br>--}}
    {{--@include('componentes.tabela_modelos',--}}
                                {{--[--}}
                                {{--'titulos' => $titulos,--}}
                                {{--'dados' => $modelos,--}}
                                {{--'rota_edicao' => 'controle_modelos.edit',--}}
                                {{--'rota_exclusao' => 'controle_modelos.destroy',--}}
                                {{--'rota_criacao' => 'controle_modelos_create',--}}
                                {{--'rota_exibicao_modelo' => 'controle_modelos.show',--}}
                                {{--'rota_exibicao_regras' => 'show_regras',--}}
                                {{--'rota_exibicao_tarefas' => 'show_tarefas',--}}
                                {{--'botao' => 'Criar Novo Modelo',--}}
                                {{--'parametro1' => 'organizacao_id',--}}
                                {{--'parametro2' => 'projeto_id',--}}
                                {{--'organizacao_id' => $organizacao->id,--}}
                                {{--'projeto_id' => $projeto->id,--}}
                                {{--'qt_parametros' => 4--}}
                                {{--])--}}
{{--@endsection--}}


@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',['titulo' => 'Modelos'])

    @includeIf('layouts.layout_admin_new.componentes.tables',[
                    'titulos' => $titulos,
                    'modelos' => $modelos,
                    'rota_edicao' => 'controle_modelos.edit',
                    'rota_exclusao' => 'controle_modelos.destroy',
                    'rota_cricao' => 'controle_modelos.create',
                    'rota_exibicao' => 'controle_modelos.show',
                    'nome_botao' => 'Novo',
                    'titulo' =>'Modelos'
    ])
@endsection