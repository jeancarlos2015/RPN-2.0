@if(!empty($logs))
    <tbody>

    @foreach($logs as $log)
        <tr>
            <td>{!! $log->codlog !!}</td>
            <td>{!! $log->nome !!}</td>
            <td>{!! $log->descricao !!}</td>
            <td>{!! $log->usuario->name !!}</td>
            <td>
                @if(!empty($rota_edicao))
                    @include('componentes.link',['id' => $log->codlog, 'rota' => $rota_edicao])
                @endif
                @if(!empty($rota_exclusao))
                    @include('componentes.form_delete',['id' => $log->codlog, 'rota' => $rota_exclusao])
                @endif
                @if(!empty($rota_exibicao))
                    @include('componentes.link',['id' => $log->codlog, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
@endif
