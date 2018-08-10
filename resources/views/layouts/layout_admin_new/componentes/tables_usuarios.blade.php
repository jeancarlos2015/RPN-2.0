@if(!empty($usuarios))
    <tbody>

    @foreach($usuarios as $usuario)
        <tr>

            <td>
                <div class="media">
                    <img class="d-flex mr-3 rounded-circle" src="{{ Gravatar::src($usuario->email) }}" alt=""
                         width="100">
                    <div class="media-body">
                        <strong>{!!  $usuario->name !!}</strong>
                        <div class="text-muted smaller">Email: {!! $usuario->email !!}</div>
                        @if(!empty($usuario->type))
                            <div class="text-muted smaller">Tipo: {!! $usuario->type !!}</div>
                        @else
                            <div class="text-muted smaller">Tipo: Padrão</div>
                        @endif
                        @if(!empty($usuario->organizacao))
                            <div class="text-muted smaller">Repositório: {!! $usuario->organizacao->nome !!}</div>
                        @else
                            <div class="text-muted smaller">Repositório: Nenhuma</div>
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

                @if(!empty($usuario->organizacao))
                    @includeIf('componentes.form_desvincular',['id' => $usuario->codusuario])
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
@endif
