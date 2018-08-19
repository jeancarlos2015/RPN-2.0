@extends('layouts.admin.layouts.main')
@section('content')
    @if(Auth::user()->email==='jeancarlospenas25@gmail.com' || Auth::user()->tipo==='Administrador')
        @includeIf('layouts.admin.componentes.breadcrumb',[
                          'titulo' => 'Painel',
                        'sub_titulo' => 'Usuarios',
                        'rota' => 'painel'
        ])
        @includeIf('layouts.admin.componentes.botao',['tipo' => $tipo])
        @includeIf('layouts.admin.componentes.tables',[
                        'titulos' => $titulos,
                        'usuarios' => $usuarios,
                        'rota_edicao' => 'controle_usuarios.edit',
                        'rota_exclusao' => 'controle_usuarios.destroy',
                        'nome_botao' => 'Novo',
                        'titulo' =>'Usuarios'
        ])
    @endif
@endsection
@section('modo')
    @includeIf('componentes.descricao',[
        'descricao_titulo_menu' => 'Controle de Usuários',
        'nome_titulo_menu' => 'Controle de Usuários'
    ])
@endsection