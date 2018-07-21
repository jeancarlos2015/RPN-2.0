
@if(!empty($usuarios))
    <tbody>
    
    @foreach($usuarios as $usuario)
        <tr>
            <td>{!! $usuario->name !!}</td>
            <td>{!! $usuario->email !!}</td>
            <td>{!! $usuario->type !!}</td>
            <td>{!! $usuario->password !!}</td>
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
            </td>
        </tr>
    @endforeach
    </tbody>
@endif
