@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                      'titulo' => 'Painel',
                    'sub_titulo' => 'Usuários',
                    'rota' => 'painel'
    ])
    <div class="card form-group card-box">
        <div class="card-header">
            <h4><strong>Vinculação De Usuários</strong></h4>
        </div>
        <form action="{!! route('vincular_usuario_repositorio') !!}" method="post">
            @method('POST')

            @csrf
            @includeIf('vinculo_usuario_repositorio.form',[
            'usuario' => $usuario,
            'repositorios' => $repositorios
            ])
        </form>
    </div>

    <div class="card form-group">
        <div class="card-header">
            <h4><strong>Edição De Usuários</strong></h4>
        </div>

        <form action="{!! route('controle_usuarios.update',['id' => $usuario->codusuario]) !!}" method="post"
              class="card-body">
            @csrf
            @method('PUT')
            @includeIf('controle_usuario.form',
            [
            'acao' => 'Atualizar',
            'usuario' => $usuario,
            'dados' => $dados,
            'codusuario' => $usuario->codusuario
            ])
        </form>

    </div>

@endsection
