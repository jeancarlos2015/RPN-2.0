{{--@extends('layouts.modelagem.main_area_modelador2')--}}


{{--@section('content')--}}
{{--{!! csrf_field() !!}--}}

{{--@includeIf('componentes.dados_exibicao')--}}
{{--<h4>Controle De Projetos</h4>--}}

{{--<br>--}}
{{--@include('componentes.tabela_projetos',--}}
{{--[--}}
{{--'titulos' => $titulos,--}}
{{--'dados' => $projetos,--}}
{{--'rota_edicao' => 'controle_projetos.edit',--}}
{{--'rota_exclusao' => 'controle_projetos.destroy',--}}
{{--'rota_criacao' => 'controle_projetos_create',--}}
{{--'rota_exibicao_modelos' => 'controle_projetos.show',--}}
{{--'botao' => 'Criar Novo projeto',--}}
{{--'parametro1' => 'organizacao_id',--}}
{{--'organizacao_id' => $organizacao_id,--}}
{{--'qt_parametros' => 2--}}
{{--])--}}

{{--@endsection--}}


@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                      'titulo' => 'Paianel',
                    'sub_titulo' => 'Projetos',
                    'rota' => 'todos_projetos'
    ])
    @if(!empty($organizacao))
        @includeIf('layouts.layout_admin_new.componentes.botao',['tipo' => $tipo])
    @endif
    @includeIf('layouts.layout_admin_new.componentes.tables',[
                    'titulos' => $titulos,
                    'projetos' => $projetos,
                    'rota_edicao' => 'controle_projetos.edit',
                    'rota_exclusao' => 'controle_projetos.destroy',
                    'rota_cricao' => 'controle_projetos.create',
                    'rota_exibicao' => 'controle_projetos.show',
                    'nome_botao' => 'Novo',
                    'botao' => 'Novo',
                    'titulo' => 'Projetos'
    ])
@endsection