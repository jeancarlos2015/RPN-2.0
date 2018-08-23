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

                        'sub_titulo' => 'Painel/Todos Projetos',
                        'rota' => 'painel'
        ])
    @endif

    @includeIf('layouts.admin.componentes.tables',[
                    'titulos' => $titulos,
                    'projetos' => $projetos,
                    'rota_edicao' => 'controle_projetos.edit',
                    'rota_exclusao' => 'controle_projetos.destroy',
                    'rota_cricao' => 'controle_projetos.create',
                    'rota_exibicao' => 'controle_projetos.show',
                    'nome_botao' => 'Novo',
                    'botao' => 'Novo',
                    'titulo' => 'Projetos - Clique no projeto desejado para gerenciar seus modelos!!'
    ])
@endsection

@section('modo')
    @includeIf('componentes.descricao',[
        'descricao_titulo_menu' => 'Controle de projetos',
        'nome_titulo_menu' => 'Controle de projetos'
    ])
@endsection