@if(!empty($projetos))
    <tbody>

    @foreach($projetos as $projeto1)
        <tr>
            {{--<td>{!! $projeto1->codprojeto !!}</td>--}}

            {{--<td>{!! $projeto1->nome !!}</td>--}}
            {{--<td>{!! $projeto1->descricao !!}</td>--}}
            {{--@if(!empty($projeto1->repositorio->nome))--}}
            {{--<td>{!! $projeto1->repositorio->nome !!}</td>--}}
            {{--@else--}}
            {{--<td>Foi Removido/Não Informado</td>--}}
            {{--@endif--}}
            @if(!empty($projeto1->usuario))
                <td>
                    <a href="{!! route($rota_exibicao,[$projeto1->codprojeto]) !!}">
                        <div class="media">

                            <img class="d-flex mr-3 rounded-circle" src="{{ Gravatar::src($projeto1->usuario->email) }}"
                                 alt="" width="100">
                            <div class="media-body">
                                <strong>Projeto - {!!  $projeto1->nome !!}</strong>
                                <div class="text-muted smaller">Responsável: {!! $projeto1->usuario->name !!}</div>
                                <div class="text-muted smaller">Descrição do Projeto: {!! $projeto1->descricao !!}</div>
                                <div class="text-muted smaller">Repositório: {!! $projeto1->repositorio->nome !!}</div>
                                <div class="text-muted smaller">Modelos: {!! count($projeto1->modelos_diagramaticos) + count($projeto1->modelos_declarativos) !!}</div>
                            </div>
                        </div>
                    </a>

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
            @endif

        </tr>
    @endforeach
    </tbody>
@endif