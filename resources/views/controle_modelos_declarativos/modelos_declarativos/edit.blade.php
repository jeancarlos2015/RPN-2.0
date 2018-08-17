@extends('layouts.admin.layouts.main')
@section('content')
    @includeIf('layouts.admin.componentes.breadcrumb',[
                   'titulo' => 'Painel',
                   'sub_titulo' =>
                   'Repositório/'.$repositorio->nome.
                   'Projeto/'.$projeto->nome.
                   'ModeloDiagramatico'.$modelo->nome.
                   'ModeloDiagramatico',
                   'rota' => 'controle_repositorios.index'
    ])
    @includeIf('controle_modelos_declarativos.modelos_declarativos.componentes.form_update')
@endsection
@section('modo')
    @includeIf('componentes.descricao',[
        'descricao_titulo_menu' => 'Modo de Criação do modelo declarativo',
        'nome_titulo_menu' => 'Edição do Modelo Declarativo'
    ])
@endsection