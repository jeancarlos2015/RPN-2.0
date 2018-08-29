@extends('layouts.admin.layouts.main')
@section('content')
    @includeIf('layouts.admin.componentes.breadcrumb',[
                      'titulo' => 'Painel',
                    'sub_titulo' => 'Repositório/'.
                    $regra->repositorio->nome.
                    '/Projetos/'.
                    $regra->projeto->nome.
                     '/Modelo/'.$regra->modelodeclarativo->nome.
                     '/Regra/'.$regra->cod_regra,
                    'rota' => 'todos_projetos'
    ])
    @includeIf('controle_regras.componentes.campos_disable')
@endsection
@section('modo')
    @includeIf('componentes.descricao',[
        'descricao_titulo_menu' => 'Controle de projetos',
        'nome_titulo_menu' => 'Controle de projetos'
    ])
@endsection