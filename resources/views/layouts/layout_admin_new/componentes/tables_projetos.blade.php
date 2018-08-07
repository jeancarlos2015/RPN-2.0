@if(!empty($projetos))
    <tbody>

    @foreach($projetos as $projeto1)
        <tr>
            {{--<td>{!! $projeto1->codprojeto !!}</td>--}}

            {{--<td>{!! $projeto1->nome !!}</td>--}}
            {{--<td>{!! $projeto1->descricao !!}</td>--}}
            {{--@if(!empty($projeto1->organizacao->nome))--}}
                {{--<td>{!! $projeto1->organizacao->nome !!}</td>--}}
            {{--@else--}}
                {{--<td>Foi Removido/Não Informado</td>--}}
            {{--@endif--}}
            <td>
                <div class="media">
                    <img class="d-flex mr-3 rounded-circle" src="{{ Gravatar::src($projeto1->usuario->email) }}" alt="" width="30">
                    <div class="media-body">
                        <strong>{!! $projeto1->usuario->name !!}</strong>
                        <div class="text-muted smaller">Código da Projeto: {!! $projeto1->codprojeto !!}</div>
                        <div class="text-muted smaller">Nome da Projeto: {!! $projeto1->nome !!} </div>
                        <div class="text-muted smaller">Descrição da Projeto: {!! $projeto1->descricao !!}</div>
                    </div>
                </div>
            </td>

            <td>
                @if(Auth::user()->email===$projeto1->usuario->email)
                    @if(!empty($rota_edicao))
                        @include('componentes.link',['id' => $projeto1->codprojeto, 'rota' => $rota_edicao])
                    @endif
                    @if(!empty($rota_exclusao))
                        @include('componentes.form_delete',['id' => $projeto1->codprojeto, 'rota' => $rota_exclusao])
                    @endif
                    @if(!empty($rota_exibicao))
                        @include('componentes.link',['id' => $projeto1->codprojeto, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
                    @endif
                @else
                    @if(!empty($rota_exibicao))
                        @include('componentes.link',['id' => $projeto1->codprojeto, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
                    @endif
                @endif


            </td>
        </tr>
    @endforeach
    </tbody>
@endif