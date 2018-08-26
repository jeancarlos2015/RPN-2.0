@extends('layouts.admin.layouts.main')
@section('content')
    @includeIf('layouts.admin.componentes.breadcrumb',[
    'titulo' => 'Painel',
    'sub_titulo' => ''

    ])

    @includeIf('layouts.admin.componentes.cards')
@endsection
@section('modo')
    @includeIf('componentes.titulo_menu_superior',[
    'titulo' => 'Painel Principal',
    'descricao' => 'Painel Principal'
    ])
@endsection


@section('codigo_css')
    <style>
        .desce-painel{
            margin-top: 2%;
        }
    </style>

@endsection