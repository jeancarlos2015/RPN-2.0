@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    @if(Auth::user()->email==='jeancarlospenas25@gmail.com')
        {!! csrf_field() !!}
        @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                          'titulo' => 'Paianel',
                        'sub_titulo' => 'Usuarios',
                        'rota' => 'painel'
        ])
        @includeIf('layouts.layout_admin_new.componentes.botao',['tipo' => $tipo])
        
        @includeIf('layouts.layout_admin_new.componentes.tables',[
                        'titulos' => $titulos,
                        'usuarios' => $usuarios,
                        'rota_edicao' => 'controle_usuarios.edit',
                        'rota_exclusao' => 'controle_usuarios.destroy',
                        'nome_botao' => 'Novo',
                        'titulo' =>'Usuarios'
        ])
    @endif

@endsection
