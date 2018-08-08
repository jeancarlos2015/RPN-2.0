
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
    @includeIf('layouts.layout_admin_new.componentes.tables',[
                       'titulos' => $titulos,
                       'usuarios' => $usuarios,
                       'rota_edicao' => 'controle_usuarios.edit',
                       'rota_exclusao' => 'controle_usuarios.destroy',
                       'nome_botao' => 'Novo',
                       'titulo' =>'Usuarios'
       ])
@endsection
