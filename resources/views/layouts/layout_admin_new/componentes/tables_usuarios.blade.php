@if(!empty($usuarios))
    <tbody>

    @foreach($usuarios as $usuario)
        <tr>

            <td>
                <div class="media">
                    <img class="d-flex mr-3 rounded-circle" src="{{ Gravatar::src($usuario->email) }}" alt=""
                         width="100">
                    <div class="media-body">
                        @if($usuario->email==='jeancarlospenas25@gmail.com')
                            <strong>{!!  $usuario->name !!}</strong>
                            <div class="text-muted smaller">Email: {!! $usuario->email !!}</div>
                            <div class="text-muted smaller">Tipo: Administrador</div>
                            @if(!empty($usuario->repositorio))
                                <div class="text-muted smaller">Repositório: {!! $usuario->repositorio->nome !!}</div>
                            @else
                                <div class="text-muted smaller">Repositório: Nenhuma</div>
                            @endif

                        @else
                            <strong>{!!  $usuario->name !!}</strong>
                            <div class="text-muted smaller">Email: {!! $usuario->email !!}</div>
                            @if(!empty($usuario->type))
                                <div class="text-muted smaller">Tipo: {!! $usuario->type !!}</div>
                            @else
                                <div class="text-muted smaller">Tipo: Padrão</div>
                            @endif
                            @if(!empty($usuario->repositorio))
                                <div class="text-muted smaller">Repositório: {!! $usuario->repositorio->nome !!}</div>
                            @else
                                <div class="text-muted smaller">Repositório: Nenhuma</div>
                            @endif
                        @endif
                    </div>
                </div>
            </td>
            <td>
                @if(!empty($rota_edicao))
                    @include('componentes.link',['id' => $usuario->codusuario, 'rota' => $rota_edicao])
                @endif
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
            </td>
        </tr>
    @endforeach
    </tbody>
@endif
