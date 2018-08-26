@if(!empty($rota_edicao))
    @include('componentes.link',['id' => $usuario->codusuario, 'rota' => $rota_edicao])
@endif
@include('componentes.link',['id' => $usuario->codusuario, 'rota' => 'edit_vinculo','edite_vinculo' => 'true'])



@if(!empty($rota_exclusao))
    @include('componentes.form_delete',['id' => $usuario->codusuario, 'rota' => $rota_exclusao])
@endif


@if(!empty($rota_exibicao))
    @include('componentes.link',['id' => $usuario->codusuario, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
@endif


@if(!empty($usuario->repositorio))
    @includeIf('componentes.form_desvincular',[
    'id' => $usuario->codusuario
    ])
@endif
