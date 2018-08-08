@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                      'titulo' => 'Painel',
                    'sub_titulo' => 'Usuários',
                    'rota' => 'painel'
    ])

    <form action="{!! route('controle_usuarios.update',['id' => $usuario->codusuario]) !!}" method="post">
        @csrf
        {{ method_field('PUT')}}
        @includeIf('controle_usuario.form',
        [
        'acao' => 'Atualizar',
        'usuario' => $usuario,
        'dados' => $dados,
        'codusuario' => $usuario->codusuario
        ]
        )
    </form>
    @if(!empty($usuario))
        <br>
        <h3 class="text-center">OU</h3>
        <form action="{!! route('controle_usuarios.update',['id' => $usuario->codusuario]) !!}" method="post">
            {{ method_field('PUT')}}
            @csrf
            <div class="form-group">
                <label class="control-label" for="desvincular">Deseja Limpar Vínculo deste Usuário?</label>
                <div class="controls">
                    <input name="desvincular" type="hidden" value="false">
                    <label class="switch-light switch-candy">
                        <input type="checkbox" name="desvincular"
                               value="true">
                        <span>
                <span>Não <i class='fa fa-thumbs-down'></i></span>
                <span>Sim <i class='fa fa-thumbs-up'></i></span>
            <a></a>
          </span>
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-dark form-control">Executar</button>

        </form>
    @endif
@endsection
