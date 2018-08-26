@extends('layouts.admin.layouts.main')
@section('content')
    @if(!empty($repositorio))
        @includeIf('layouts.admin.componentes.breadcrumb',[
                          'titulo' => 'Painel',

                        'sub_titulo' => 'Repositório / '.$repositorio->nome.' / Projetos',
                        'rota' => 'painel'
        ])
        @includeIf('layouts.admin.componentes.botao',['tipo' => $tipo])
    @else
        @includeIf('layouts.admin.componentes.breadcrumb',[
                          'titulo' => 'Painel',

                        'sub_titulo' => 'Painel/Todos Grupos',
                        'rota' => 'painel'
        ])
    @endif

    @includeIf('layouts.admin.componentes.tables',[
                    'titulos' => $titulos,
                    'projetos' => $atribuicao_projeto_usuarios,
                    'rota_edicao' => 'controle_atribuicao_projeto_usuarios.edit',
                    'rota_exclusao' => 'controle_atribuicao_projeto_usuarios.destroy',
                    'rota_cricao' => 'controle_atribuicao_projeto_usuarios.create',
                    'rota_exibicao' => 'controle_atribuicao_projeto_usuarios.show',
                    'nome_botao' => 'Novo',
                    'botao' => 'Novo',
                    'titulo' => 'Projetos - Clique no projeto desejado para gerenciar seus Grupos!!'
    ])
@endsection

@section('modo')
    @includeIf('componentes.descricao',[
        'descricao_titulo_menu' => 'Controle de Grupos',
        'nome_titulo_menu' => 'Controle de Grupos'
    ])
@endsection