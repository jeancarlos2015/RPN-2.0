
@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                      'titulo' => 'Painel',
                    'sub_titulo' => 'Usuários',
                    'rota' => 'painel'
    ])

    <form action="{!! route('controle_usuarios.store') !!}" method="post">
        @includeIf('controle_usuario.form',['acao' => 'Criar Usuário'])
    </form>
@endsection

@section('modo')
    @includeIf('componentes.descricao',[
        'descricao_titulo_menu' => 'Controle de Usuários',
        'nome_titulo_menu' => 'Controle de Usuários'
    ])
@endsection