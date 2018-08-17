@extends('layouts.admin.layouts.main')

@section('content')
    @includeIf('layouts.admin.componentes.breadcrumb',[
                    'titulo' => 'Modelos',
                    'rota' => 'painel'
    ])
@endsection

@section('modo')
    @includeIf('componentes.descricao',[
        'descricao_titulo_menu' => 'Modo de Visualização do modelo declarativo',
        'nome_titulo_menu' => 'Visualização Do Modelo Declarativo'
    ])
@endsection