@extends('layouts.admin.layouts.main')
@section('content')
        @includeIf('layouts.admin.componentes.breadcrumb',[
                        'titulo' => 'Painel',
                        'sub_titulo' => 'Repositórios',
                        'rota' => 'painel'
        ])
        @includeIf('layouts.admin.componentes.botao',['tipo' => $tipo])
        @includeIf('layouts.admin.componentes.tables',[
                        'titulos' => $titulos,
                        'repositorios' => $repositorios,
                        'rota_edicao' => 'controle_repositorios.edit',
                        'rota_exclusao' => 'controle_repositorios.destroy',
                        'rota_cricao' => 'controle_repositorios.create',
                        'rota_exibicao' => 'controle_repositorios.show',
                        'nome_botao' => 'Novo',
                        'titulo' =>'Repositórios',
                        'tipo' => $tipo

        ])
@endsection
@section('modo')
    @includeIf('componentes.descricao',[
        'descricao_titulo_menu' => 'Controle de Repositórios',
        'nome_titulo_menu' => 'Repositórios'
    ])
@endsection