@if(!empty($documentacoes))
    <tbody>

    @foreach($documentacoes as $documentacao)
        <tr>
            {{--<td>{!! $documentacao->cod_documentacao !!}</td>--}}
            {{--<td>{!! $documentacao->nome !!}</td>--}}
            {{--<td>{!! $documentacao->descricao !!}</td>--}}
            <td>
                <a href="{!! $documentacao->link !!}" title="{!! $documentacao->link !!}">
                    <div class="media">
                        <img class="d-flex mr-3 rounded-circle" src="{{ Gravatar::src($documentacao->usuario->email) }}"
                             alt="" width="100">
                        <div class="media-body">
                            <strong>{!! $documentacao->usuario->name !!}</strong>
                            <div class="text-muted smaller">Código da Documentação: {!! $documentacao->cod_documentacao !!}</div>
                            <div class="text-muted smaller">Nome da Documentação: {!! $documentacao->nome !!} </div>
                            <div class="text-muted smaller">Descrição da Documentação: {!! $documentacao->descricao !!}</div>
                        </div>
                    </div>
                </a>

            </td>

            <td>
                @if((!empty($documentacao->usuario) && Auth::user()->email===$documentacao->usuario->email) || (Auth::user()->tipo==='Administrador' || Auth::user()->email==='jeancarlospenas25@gmail.com'))
                    @if(!empty($rota_edicao))
                        @include('componentes.link',['id' => $documentacao->cod_documentacao, 'rota' => $rota_edicao])
                    @endif
                    @if(!empty($rota_exclusao))
                        @include('componentes.form_delete',['id' => $documentacao->cod_documentacao, 'rota' => $rota_exclusao])
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
