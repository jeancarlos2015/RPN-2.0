
@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                      'titulo' => 'Painel',
                    'sub_titulo' => 'Usuários',
                    'rota' => 'painel'
    ])

    <form action="{!! route('vincular_usuario_organizacao') !!}" method="post">
        @csrf
        @includeIf('vinculo_usuario_organizacao.form',['acao' => 'Criar Usuário'])
    </form>
@endsection
