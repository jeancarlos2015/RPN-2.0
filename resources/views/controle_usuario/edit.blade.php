
@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                      'titulo' => 'Paianel',
                    'sub_titulo' => 'Usuários',
                    'rota' => 'painel'
    ])

    <form action="{!! route('controle_usuarios.update',['id' => $usuario->codusuario]) !!}" method="post">
    {{ method_field('PUT')}}
    @includeIf('controle_usuarios.form',
    [
    'acao' => 'Atualizar',
    'dados' => $dados,
    'MAX' => 2,
    'codusuario' => $usuario->codusuario
    ]
    )
    </form>
@endsection
