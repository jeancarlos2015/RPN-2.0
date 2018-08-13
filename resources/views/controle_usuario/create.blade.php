
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
    <li class="nav-item">
        <a class="nav-link" title="Modo de Edição de Objeto de Fluxo">
            <p class="fa fa-dashboard"> Controle de Usuários</p>
            <span class="sr-only"></span>
        </a>
    </li>
@endsection