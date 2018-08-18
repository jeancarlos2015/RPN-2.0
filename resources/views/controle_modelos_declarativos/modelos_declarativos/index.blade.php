
@extends('layouts.admin.layouts.main')

@section('content')
    @includeIf('layouts.admin.componentes.breadcrumb',[
                    'titulo' => 'Painel',
                    'rota' => 'painel',
                    'sub_titulo' => 'Repositório/'.$repositorio->nome.'Projetos/'.$projeto->nome.'/Modelos'
    ])
    @if(!empty($repositorio))
            @includeIf('layouts.admin.componentes.botao',['tipo' => $tipo])
    @endif
    @includeIf('layouts.admin.componentes.tables',[
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
        'descricao_titulo_menu' => 'Modo de Visualização do modelo declarativo',
        'nome_titulo_menu' => 'Visualização do Modelo Declarativo'
    ])
@endsection