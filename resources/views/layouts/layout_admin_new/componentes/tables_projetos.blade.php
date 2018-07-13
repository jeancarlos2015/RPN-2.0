@if(!empty($projetos))
    <tbody>

    @foreach($projetos as $projeto1)
        <tr>
            <td>{!! $projeto1->codprojeto !!}</td>

            <td>{!! $projeto1->nome !!}</td>
            <td>{!! $projeto1->descricao !!}</td>
            @if(!empty($projeto1->organizacao->nome))
                <td>{!! $projeto1->organizacao->nome !!}</td>
            @else
                <td>Foi Removido/Não Informado</td>
            @endif
            <td>
                @if(!empty($rota_edicao))
                    @include('componentes.link',['id' => $projeto1->codprojeto, 'rota' => $rota_edicao])
                @endif
                @if(!empty($rota_exclusao))
                    @include('componentes.form_delete',['id' => $projeto1->codprojeto, 'rota' => $rota_exclusao])
                @endif
                @if(!empty($rota_exibicao))
                    @include('componentes.link',['id' => $projeto1->codprojeto, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
                @endif

            </td>
        </tr>
    @endforeach
    </tbody>
@endif