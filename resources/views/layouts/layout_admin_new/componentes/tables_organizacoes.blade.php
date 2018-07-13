@if(!empty($organizacoes))
    <tbody>
    @foreach($organizacoes as $organizacao1)
        <tr>
            <td>{!! $organizacao1->codorganizacao !!}</td>
            <td>{!! $organizacao1->nome !!}</td>
            <td>{!! $organizacao1->descricao !!}</td>
            <td>
                @if(!empty($rota_edicao))
                    @include('componentes.link',['id' => $organizacao1->codorganizacao, 'rota' => $rota_edicao])
                @endif
                @if(!empty($rota_exclusao))
                    @include('componentes.form_delete',['id' => $organizacao1->codorganizacao, 'rota' => $rota_exclusao])
                @endif
                @if(!empty($rota_exibicao))
                    @include('componentes.link',['id' => $organizacao1->codorganizacao, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
@endif