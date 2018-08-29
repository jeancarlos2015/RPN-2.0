@if(!empty($modelos))
    <tbody>
    @foreach($modelos as $modelo1)
        <tr>
            {{--<td>{!! $modelo1->cod_modelo_diagramatico !!}</td>--}}
            {{--<td>{!! $modelo1->nome !!}</td>--}}
            {{--<td>{!! $modelo1->descricao !!}</td>--}}
            {{--<td>{!! $modelo1->tipo !!}</td>--}}
            <td>
                @if($modelo1->tipo==='bpmn')
                    <a href="{!! route($rota_exibicao,[$modelo1->cod_modelo_diagramatico]) !!}">
                        <div class="media">
                            @if(!empty($modelo1->usuario->email))
                                <img class="d-flex mr-3 rounded-circle"
                                     src="{{ Gravatar::src($modelo1->usuario->email) }}"
                                     alt="" width="100">
                            @else
                                <img class="d-flex mr-3 rounded-circle"
                                     src="{{ Gravatar::src('removido@gmail.com') }}"
                                     alt="" width="100">
                            @endif
                            <div class="media-body">
                                <strong>Modelo - {!!  $modelo1->nome !!}</strong>
                                @if(!empty($modelo1->usuario))
                                    <div class="text-muted smaller">Responsável: {!! $modelo1->usuario->name !!}</div>
                                @endif
                                <div class="text-muted smaller">Descrição do Modelo: {!! $modelo1->descricao !!}</div>
                                <div class="text-muted smaller">Tipo: {!! $modelo1->tipo !!}</div>
                                <div class="text-muted smaller">Projeto: {!! $modelo1->projeto->nome !!}</div>
                                @if(!empty($modelo1->repositorio->nome))
                                    <div class="text-muted smaller">
                                        Repositório: {!! $modelo1->repositorio->nome !!}</div>
                                @endif
                            </div>
                        </div>
                    </a>
                @else
                    <a href="{!! route('controle_modelos_declarativos.show',[$modelo1->cod_modelo_declarativo]) !!}">
                        <div class="media">
                            @if(!empty($modelo1->usuario))
                                <img class="d-flex mr-3 rounded-circle"
                                     src="{{ Gravatar::src($modelo1->usuario->email) }}"
                                     alt="" width="100">
                            @else
                                <img class="d-flex mr-3 rounded-circle"
                                     src="{{ Gravatar::src('removido@gmail.com') }}"
                                     alt="" width="100">
                            @endif
                            <div class="media-body">
                                <strong>Modelo - {!!  $modelo1->nome !!}</strong>
                                @if(!empty($modelo1->usuario))
                                    <div class="text-muted smaller">Responsável: {!! $modelo1->usuario->name !!}</div>
                                @endif
                                <div class="text-muted smaller">Descrição do Modelo: {!! $modelo1->descricao !!}</div>
                                <div class="text-muted smaller">Tipo: {!! $modelo1->tipo !!}</div>
                                <div class="text-muted smaller">Projeto: {!! $modelo1->projeto->nome !!}</div>
                                @if(!empty($modelo1->repositorio->nome))
                                    <div class="text-muted smaller">
                                        Repositório: {!! $modelo1->repositorio->nome !!}</div>
                                @endif
                                <div class="text-muted smaller">Objetos de
                                    fluxo: {!! count($modelo1->objetos_fluxos) !!}</div>
                            </div>
                        </div>
                    </a>
                @endif
            </td>
            @if($modelo1->tipo==='bpmn')
                <td>

                    @if(!empty($modelo1->usuario) && Auth::user()->email===$modelo1->usuario->email || Auth::user()->tipo==='Administrador' || Auth::user()->email==='jeancarlospenas25@gmail.com')
                        @if(!empty($rota_edicao))
                            @include('componentes.link',['id' => $modelo1->cod_modelo_diagramatico, 'rota' => $rota_edicao])
                        @endif
                        @if(!empty($rota_exclusao))
                            @include('componentes.form_delete',['id' => $modelo1->cod_modelo_diagramatico, 'rota' => $rota_exclusao])
                        @endif
                        @if(!empty($rota_exibicao))
                            @include('componentes.link',['id' => $modelo1->cod_modelo_diagramatico, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
                        @endif
                    @else
                        @if(!empty($rota_exibicao))
                            @include('componentes.link',['id' => $modelo1->cod_modelo_diagramatico, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
                        @endif
                    @endif
                </td>
            @else
                <td>
                    @if(!empty($modelo1->usuario) && Auth::user()->email===$modelo1->usuario->email || Auth::user()->tipo==='Administrador' || Auth::user()->email==='jeancarlospenas25@gmail.com')
                        @if(!empty($rota_edicao))
                            @include('componentes.link',['id' => $modelo1->cod_modelo_declarativo, 'rota' => 'controle_modelos_declarativos.edit'])
                        @endif
                        @if(!empty($rota_exclusao))
                            @include('componentes.form_delete',['id' => $modelo1->cod_modelo_declarativo, 'rota' => 'controle_modelos_declarativos.destroy'])
                        @endif
                        @if(!empty($rota_exibicao))
                            @include('componentes.link',['id' => $modelo1->cod_modelo_declarativo, 'rota' => 'controle_modelos_declarativos.show','nomebotao' => 'Visualizar'])
                        @endif
                    @else
                        @if(!empty($rota_exibicao))
                            @include('componentes.link',['id' => $modelo1->cod_modelo_declarativo, 'rota' => 'controle_modelos_declarativos.show','nomebotao' => 'Visualizar'])
                        @endif
                    @endif
                </td>
            @endif
        </tr>
    @endforeach
    </tbody>
@endif