@extends('layouts.admin.layouts.main')

@section('content')
    @includeIf('layouts.admin.componentes.breadcrumb',[
                   'titulo' => 'Painel',
                   'rota' => 'painel',
                   'sub_titulo' => 'Novo Repositório'
   ])

    @includeIf('controle_repositorios.componentes.form_repositorio_create')
@endsection

@section('modo')
    @includeIf('componentes.descricao',[
        'descricao_titulo_menu' => 'Controle de Repositórios',
        'nome_titulo_menu' => 'Modo de Criação do Repositório'
    ])
@endsection