@extends('layouts.admin.layouts.main')
@section('content')
    @includeIf('layouts.admin.componentes.breadcrumb',[
                    'titulo' => 'Painel',
                    'sub_titulo' => 'Repositórios',
                    'rota' => 'painel'
    ])
@endsection
@section('modo')
    @includeIf('componentes.descricao',[
        'descricao_titulo_menu' => 'Visualização do Repositório',
        'nome_titulo_menu' => 'Visualização do Repositório'
    ])
@endsection