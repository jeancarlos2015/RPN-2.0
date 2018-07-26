@if(!empty($documentacoes))
    <tbody>

    @foreach($documentacoes as $documentacao)
        <tr>
            <td>{!! $documentacao->coddocumentacao !!}</td>
            <td>{!! $documentacao->nome !!}</td>
            <td>{!! $documentacao->descricao !!}</td>
            <td>{!! $documentacao->acao !!}</td>
            <td>
                @if(!empty($rota_edicao))
                    @include('componentes.link',['id' => $documentacao->coddocumentacao, 'rota' => $rota_edicao])
                @endif
                @if(!empty($rota_exclusao))
                    @include('componentes.form_delete',['id' => $documentacao->coddocumentacao, 'rota' => $rota_exclusao])
                @endif

                    <div class="form-group">
                        <a href="{!! $documentacao->link !!}"><img src="{!! asset('img/olho.png') !!} " style="width: 20px" title="Visualizar"></a>
                    </div>
            </td>
        </tr>
    @endforeach
    </tbody>
@endif
