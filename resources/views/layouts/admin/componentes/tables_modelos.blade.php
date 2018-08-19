@if(!empty($modelos))
    <tbody>
    @foreach($modelos as $modelo1)
        <tr>
            {{--<td>{!! $modelo1->codmodelodiagramatico !!}</td>--}}
            {{--<td>{!! $modelo1->nome !!}</td>--}}
            {{--<td>{!! $modelo1->descricao !!}</td>--}}
            {{--<td>{!! $modelo1->tipo !!}</td>--}}
            <td>
                @if($modelo1->tipo==='diagramatico')
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
                @else
                    <a href="{!! route('controle_modelos_declarativos.show',[$modelo1->codmodelodeclarativo]) !!}">
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
                                <div class="text-muted smaller">Objetos de
                                    fluxo: {!! count($modelo1->objetos_fluxos) !!}</div>
                            </div>
                        </div>
                    </a>
                @endif
            </td>
            @if($modelo1->tipo==='diagramatico')
                <td>
                    @if(Auth::user()->email===$modelo1->usuario->email)
                        @if(!empty($rota_edicao))
                            @include('componentes.link',['id' => $modelo1->codmodelodiagramatico, 'rota' => $rota_edicao])
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
            @else
                <td>
                    @if(Auth::user()->email===$modelo1->usuario->email)
                        @if(!empty($rota_edicao))
                            @include('componentes.link',['id' => $modelo1->codmodelodeclarativo, 'rota' => 'controle_modelos_declarativos.edit'])
                        @endif
                        @if(!empty($rota_exclusao))
                            @include('componentes.form_delete',['id' => $modelo1->codmodelodeclarativo, 'rota' => 'controle_modelos_declarativos.destroy'])
                        @endif
                        @if(!empty($rota_exibicao))
                            @include('componentes.link',['id' => $modelo1->codmodelodeclarativo, 'rota' => 'controle_modelos_declarativos.show','nomebotao' => 'Visualizar'])
                        @endif
                    @else
                        @if(!empty($rota_exibicao))
                            @include('componentes.link',['id' => $modelo1->codmodelodeclarativo, 'rota' => 'controle_modelos_declarativos.show','nomebotao' => 'Visualizar'])
                        @endif
                    @endif
                </td>
            @endif
        </tr>
    @endforeach
    </tbody>
@endif