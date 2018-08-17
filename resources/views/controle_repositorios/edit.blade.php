@extends('layouts.admin.layouts.main')

@section('content')
    @includeIf('layouts.admin.componentes.breadcrumb',[
                    'titulo' => 'Painel',
                    'sub_titulo' => 'Repositórios',
                    'rota' => 'controle_repositorios.index'
    ])
    @includeIf('controle_repositorios.componentes.form_repositorio_update')
@endsection

@section('modo')
    @includeIf('componentes.descricao',[
        'descricao_titulo_menu' => 'Controle de Repositórios',
        'nome_titulo_menu' => 'Modo de Edição do Repositório'
    ])
@endsection