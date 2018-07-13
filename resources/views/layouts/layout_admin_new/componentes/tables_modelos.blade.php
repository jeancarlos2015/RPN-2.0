@if(!empty($modelos))
    <tbody>
    @foreach($modelos as $modelo1)
        <tr>
            <td>{!! $modelo1->codmodelo !!}</td>
            <td>{!! $modelo1->nome !!}</td>
            <td>{!! $modelo1->descricao !!}</td>
            <td>{!! $modelo1->tipo !!}</td>
            <td>

                @if(!empty($rota_edicao))
                    @include('componentes.link',['id' => $modelo1->codmodelo, 'rota' => $rota_edicao])
                @endif
                @if(!empty($rota_exclusao))
                    @include('componentes.form_delete',['id' => $modelo1->codmodelo, 'rota' => $rota_exclusao])
                @endif
                @if(!empty($rota_exibicao))
                    @include('componentes.link',['id' => $modelo1->codmodelo, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
@endif