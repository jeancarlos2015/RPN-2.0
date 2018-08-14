@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                    'titulo' => 'Painel',
                    'rota' => 'painel',
                    'sub_titulo' => 'Repositório/'.$repositorio->nome.'Projetos/'.$projeto->nome.'/Modelos'
    ])
    @if(!empty($repositorio))
        @includeIf('layouts.layout_admin_new.componentes.botao',['tipo' => $tipo])
        @includeIf('layouts.layout_admin_new.componentes.botao',['tipo' => 'modelo_declarativo'])
    @endif
    @includeIf('layouts.layout_admin_new.componentes.tables',[
                    'titulos' => $titulos,
                    'modelos' => $modelos,
                    'rota_edicao' => 'controle_modelos_diagramaticos.edit',
                    'rota_exclusao' => 'controle_modelos_diagramaticos.destroy',
                    'rota_cricao' => 'controle_modelos_diagramaticos.create',
                    'rota_exibicao' => 'controle_modelos_diagramaticos.show',
                    'nome_botao' => 'Novo',
                    'titulo' =>'Modelos'
    ])
@endsection

@section('modo')
    @includeIf('componentes.descricao',[
            'descricao_titulo_menu' => 'Visualização dos modelos',
            'nome_titulo_menu' => 'Visualização dos modelos'
        ])
@endsection