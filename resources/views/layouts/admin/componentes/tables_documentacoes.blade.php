@if(!empty($documentacoes))
    <tbody>

    @foreach($documentacoes as $documentacao)
        <tr>
            {{--<td>{!! $documentacao->coddocumentacao !!}</td>--}}
            {{--<td>{!! $documentacao->nome !!}</td>--}}
            {{--<td>{!! $documentacao->descricao !!}</td>--}}
            <td>
                <a href="{!! $documentacao->link !!}" title="{!! $documentacao->link !!}">
                    <div class="media">
                        <img class="d-flex mr-3 rounded-circle" src="{{ Gravatar::src($documentacao->usuario->email) }}"
                             alt="" width="100">
                        <div class="media-body">
                            <strong>{!! $documentacao->usuario->name !!}</strong>
                            <div class="text-muted smaller">Código da Documentação: {!! $documentacao->coddocumentacao !!}</div>
                            <div class="text-muted smaller">Nome da Documentação: {!! $documentacao->nome !!} </div>
                            <div class="text-muted smaller">Descrição da Documentação: {!! $documentacao->descricao !!}</div>
                        </div>
                    </div>
                </a>

            </td>

            <td>
                @if(Auth::user()->email===$documentacao->usuario->email)
                    @if(!empty($rota_edicao))
                        @include('componentes.link',['id' => $documentacao->coddocumentacao, 'rota' => $rota_edicao])
                    @endif
                    @if(!empty($rota_exclusao))
                        @include('componentes.form_delete',['id' => $documentacao->coddocumentacao, 'rota' => $rota_exclusao])
                    @endif
                    <div class="form-group">
                        <a href="{!! $documentacao->link !!}"><img src="{!! asset('img/olho.png') !!} "
                                                                   style="width: 20px"
                                                                   title="Visualizar"></a>
                    </div>
                @else
                    <div class="form-group">
                        <a href="{!! $documentacao->link !!}"><img src="{!! asset('img/olho.png') !!} "
                                                                   style="width: 20px"
                                                                   title="Visualizar"></a>
                    </div>
                @endif


            </td>
        </tr>
    @endforeach
    </tbody>
@endif
