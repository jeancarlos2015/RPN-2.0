@if($usuario->tipo!=='Administrador' && $usuario->email!=='jeancarlospenas25@gmail.com')
    @if(Auth::user()->email==='jeancarlospenas25@gmail.com' || Auth::user()->tipo==='Administrador')
        @if(!empty($rota_edicao))
            @include('componentes.link',['id' => $usuario->codusuario, 'rota' => $rota_edicao])
            @include('componentes.link',['id' => $usuario->codusuario, 'rota' => 'edit_vinculo','edite_vinculo' => 'true'])
        @endif
    @endif

    @if(($usuario->tipo!=='Administrador' && $usuario->email!=='jeancarlospenas25@gmail.com' && Auth::user()->tipo==='Administrador')|| Auth::user()->email==='jeancarlospenas25@gmail.com')
        @if(!empty($rota_exclusao))
            @include('componentes.form_delete',['id' => $usuario->codusuario, 'rota' => $rota_exclusao])
        @endif
    @endif

    @if(!empty($rota_exibicao))
        @include('componentes.link',['id' => $usuario->codusuario, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
    @endif

    @if(Auth::user()->email==='jeancarlospenas25@gmail.com' || Auth::user()->tipo==='Administrador')
        @if(!empty($usuario->repositorio))
            @includeIf('componentes.form_desvincular',['id' => $usuario->codusuario])
        @endif
    @endif
@endif