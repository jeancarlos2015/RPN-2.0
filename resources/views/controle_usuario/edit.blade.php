@extends('layouts.admin.layouts.main')
@section('content')
    @includeIf('layouts.admin.componentes.breadcrumb',[
                      'titulo' => 'Painel',
                    'sub_titulo' => 'Usuários',
                    'rota' => 'painel'
    ])
    @includeIf('controle_usuario.componente.cards')

@endsection
@section('modo')
    @includeIf('componentes.descricao',[
        'descricao_titulo_menu' => 'Controle de Usuários',
        'nome_titulo_menu' => 'Controle de Usuários'
    ])
@endsection