@extends('layouts.admin.layouts.main')

@section('content')
    @includeIf('layouts.admin.componentes.breadcrumb',[
                   'titulo' => 'Painel',
                   'rota' => 'painel',
                   'sub_titulo' =>
                   ' Repositório /'.$repositorio->nome.
                   '/ Projeto /'.$projeto->nome.
                   '/ Modelo Declarativo'
   ])
   @includeIf('controle_modelos_declarativos.modelos_declarativos.componentes.form_create')
@endsection

@section('modo')
    @includeIf('componentes.descricao',[
        'descricao_titulo_menu' => 'Modo de Criação do modelo declarativo',
        'nome_titulo_menu' => 'Criação do Modelo Declarativo'
    ])
@endsection