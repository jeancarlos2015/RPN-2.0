@extends('layouts.admin.layouts.main')

@section('content')
    @includeIf('layouts.admin.componentes.breadcrumb',[
              'titulo' => 'Painel',
              'sub_titulo' => 'Nova Documentação',
    ])
    @includeIf('controle_documentacao.componentes.post_create_documentacao')
@endsection

@section('modo')
    @includeIf('controle_documentacao.componentes.titulo_menu_superior',[
    'titulo' => 'Criação da documentação',
    'descricao' => 'Modo de Edição de Objeto de Fluxo'
    ])
@endsection