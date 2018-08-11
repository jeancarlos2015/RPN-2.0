@if(!empty($modelos))
    <tbody>
    @foreach($modelos as $modelo1)
        <tr>
            {{--<td>{!! $modelo1->codmodelodiagramatico !!}</td>--}}
            {{--<td>{!! $modelo1->nome !!}</td>--}}
            {{--<td>{!! $modelo1->descricao !!}</td>--}}
            {{--<td>{!! $modelo1->tipo !!}</td>--}}
            <td>
                <a href="{!! route($rota_exibicao,[$modelo1->codmodelodiagramatico]) !!}">
                    <div class="media">
                        <img class="d-flex mr-3 rounded-circle" src="{{ Gravatar::src($modelo1->usuario->email) }}"
                             alt="" width="100">
                        <div class="media-body">
                            <strong>Modelo - {!!  $modelo1->nome !!}</strong>
                            <div class="text-muted smaller">Responsável: {!! $modelo1->usuario->name !!}</div>
                            <div class="text-muted smaller">Descrição do Modelo: {!! $modelo1->descricao !!}</div>
                            <div class="text-muted smaller">Tipo: {!! $modelo1->tipo !!}</div>
                            <div class="text-muted smaller">Projeto: {!! $modelo1->projeto->nome !!}</div>
                            <div class="text-muted smaller">Repositório: {!! $modelo1->repositorio->nome !!}</div>
                        </div>
                    </div>
                </a>

            </td>
            <td>
                @if(Auth::user()->email===$modelo1->usuario->email)
                    @if(!empty($rota_edicao))
                        @if($modelo1->tipo==='diagramatico')

                            {{--@include('componentes.link',['id' => $modelo1->codmodelodiagramatico, 'rota' => 'edicao_modelo_diagramatico'])--}}
                            @include('componentes.link',['id' => $modelo1->codmodelodiagramatico, 'rota' => $rota_edicao])
                        @else
                            @include('componentes.link',['id' => $modelo1->codmodelodiagramatico, 'rota' => $rota_edicao])
                        @endif

                    @endif
                    @if(!empty($rota_exclusao))
                        @include('componentes.form_delete',['id' => $modelo1->codmodelodiagramatico, 'rota' => $rota_exclusao])
                    @endif
                    @if(!empty($rota_exibicao))
                        @include('componentes.link',['id' => $modelo1->codmodelodiagramatico, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
                    @endif
                @else
                    @if(!empty($rota_exibicao))
                        @include('componentes.link',['id' => $modelo1->codmodelodiagramatico, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
                    @endif
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
@endif