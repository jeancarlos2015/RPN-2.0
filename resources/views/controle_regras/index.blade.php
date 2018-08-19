@extends('layouts.admin.layouts.main')
@section('content')
    @if(!empty($repositorio))
        @includeIf('layouts.admin.componentes.breadcrumb',[
                          'titulo' => 'Painel',

                        'sub_titulo' =>
                        'Repositório / '.
                        $repositorio->nome.
                        ' / Projeto /'.
                        $projeto->nome.
                        '/ Modelo /'.
                        $modelo_declarativo->nome.
                        '/Regras /'
                        ,
                        'rota' => 'painel'
        ])
        @includeIf('layouts.admin.componentes.botao',['tipo' => $tipo])
    @else
        @includeIf('layouts.admin.componentes.breadcrumb',[
                          'titulo' => 'Painel',

                        'sub_titulo' =>
                        'Painel/
                        Repositório/'.$repositorio->nome.
                        '/Modelos/'.$modelo_declarativo->nome.
                        '/Todas Regras',
                        'rota' => 'painel'
        ])
    @endif

    @includeIf('layouts.admin.componentes.tables',[
                    'titulos' => $titulos,
                    'projetos' => $regras,
                    'rota_edicao' => 'controle_regras.edit',
                    'rota_exclusao' => 'controle_regras.destroy',
                    'rota_criacao' => 'controle_regras.create',
                    'rota_exibicao' => 'controle_regras.show',
                    'nome_botao' => 'Novo',
                    'botao' => 'Novo',
                    'titulo' => 'Regras'
    ])
@endsection

@section('modo')
    @includeIf('componentes.descricao',[
        'descricao_titulo_menu' => 'Controle de projetos',
        'nome_titulo_menu' => 'Controle de projetos'
    ])
@endsection