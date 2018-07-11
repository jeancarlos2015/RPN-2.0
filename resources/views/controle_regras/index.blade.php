{{--@extends('layouts.modelagem.main_area_modelador2')--}}


{{--@section('content')--}}
    {{--{!! csrf_field() !!}--}}
    {{--@includeIf('componentes.dados_exibicao')--}}

    {{--<hr>--}}
    {{--<h3>Listagem de Regras</h3>--}}
    {{--<br>--}}
    {{--@include('componentes.tabela_regras',--}}
                              {{--[--}}
                              {{--'titulos' => $titulos,--}}
                              {{--'dados' => $regras,--}}
                              {{--'rota_edicao' => 'controle_regras.edit',--}}
                              {{--'rota_exclusao' => 'controle_regras.destroy',--}}
                              {{--'rota_criacao' => 'controle_regras_create',--}}
                              {{--'botao' => 'Criar Nova Regra',--}}
                               {{--'qt_parametros' => 5,--}}
                               {{--'modelo_id' => $modelo->id,--}}
                               {{--'projeto_id' => $projeto->id,--}}
                               {{--'organizacao_id' => $organizacao->id,--}}
                               {{--'parametro1' => 'organizacao_id',--}}
                               {{--'parametro2' => 'projeto_id',--}}
                               {{--'parametro3' => 'modelo_id',--}}
                              {{--])--}}
{{--@endsection--}}
{{--@includeIf('componentes.dados_exibicao')--}}

@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                    'titulo' => 'Regras',
                    'rota' => 'todas_regras'
    ])
    @includeIf('layouts.layout_admin_new.componentes.botao',['tipo' => $tipo])
    @includeIf('layouts.layout_admin_new.componentes.tables',[
                    'titulos' => $titulos,
                    'regras' => $regras,
                    'rota_edicao' => 'controle_regras.edit',
                    'rota_exclusao' => 'controle_regras.destroy',
                    'nome_botao' => 'Novo',
                    'titulo' =>'Regras'
    ])
@endsection