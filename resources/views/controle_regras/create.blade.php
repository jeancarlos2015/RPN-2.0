@extends('layouts.admin.layouts.main')
@section('content')
    @includeIf('layouts.admin.componentes.breadcrumb',[
      'titulo' => 'Painel',
    'sub_titulo' => 'Repositório/'.$repositorio->nome.'/Novo Projeto',
    'rota' => 'painel'
    ])
    @includeIf('controle_projetos.componentes.form_projeto_create')
@endsection
@section('modo')
    @includeIf('componentes.descricao',[
        'descricao_titulo_menu' => 'Controle de projetos',
        'nome_titulo_menu' => 'Controle de projetos'
    ])
@endsection