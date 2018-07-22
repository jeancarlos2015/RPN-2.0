
@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                      'titulo' => 'Paianel',
                    'sub_titulo' => 'Usuários',
                    'rota' => 'painel'
    ])

    <form action="{!! route('controle_usuarios.store') !!}" method="post">
        @includeIf('controle_usuario.form',
        [
        'acao' => 'Criar Usuário',
        'dados' => $dados,
        'MAX' => 2
        ]
        )
    </form>
@endsection
