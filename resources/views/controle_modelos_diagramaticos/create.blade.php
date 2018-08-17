
@extends('layouts.admin.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.admin.componentes.breadcrumb',[
                   'titulo' => 'Painel',
                   'rota' => 'painel',
                   'sub_titulo' =>
                   ' Repositório /'.$repositorio->nome.
                   '/ Projeto /'.$projeto->nome.
                   '/ Modelo Diagramatico'
   ])
   @includeIf('controle_modelos_diagramaticos.componentes.form_diagramatico_create')
@endsection

@section('modo')
    @includeIf('componentes.descricao',[
        'descricao_titulo_menu' => 'Você está no modo de Edição de modelo. As alterações que você fizer aqui deverão ser salvas.',
        'nome_titulo_menu' => 'Modo De Criação Do Modelo Diagramático'
    ])
@endsection