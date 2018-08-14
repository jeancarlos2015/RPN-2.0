@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
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