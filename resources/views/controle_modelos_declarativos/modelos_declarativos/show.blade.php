@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
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