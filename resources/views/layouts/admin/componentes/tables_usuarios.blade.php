@if(!empty($usuarios))
    <tbody>

    @foreach($usuarios as $usuario)
        <tr>
            @if(Auth::user()->email==='jeancarlospenas25@gmail.com')

                <td>
                    <a href="{!! route($rota_edicao,[$usuario->codusuario]) !!}">
                        <div class="media">

                            <img class="d-flex mr-3 rounded-circle" src="{{ Gravatar::src($usuario->email) }}"
                                 alt=""
                                 width="100">
                            @if(Auth::user()->tipo==='Administrador' && Auth::user()->email!=='jeancarlospenas25@gmail.com')
                                <div class="media-body">

                                    <strong>{!!  $usuario->name !!}</strong>
                                    @if(!empty($usuario->tipo))
                                        <div class="text-muted smaller">Tipo: {!! $usuario->tipo !!}</div>
                                    @else
                                        <div class="text-muted smaller">Tipo: Padrão</div>
                                    @endif
                                    @if(!empty($usuario->repositorio))
                                        <div class="text-muted smaller">
                                            Repositório: {!! $usuario->repositorio->nome !!}</div>
                                    @else
                                        <div class="text-muted smaller">Repositório: Nenhuma</div>
                                    @endif


                                </div>
                            @elseif(Auth::user()->email==='jeancarlospenas25@gmail.com')
                                <div class="media-body">
                                    <strong>{!!  $usuario->name !!}</strong>

                                    <div class="text-muted smaller">Tipo: {!! $usuario->tipo !!}</div>

                                    <div class="text-muted smaller">Email: {!! $usuario->email !!}</div>

                                    @if(!empty($usuario->repositorio))
                                        <div class="text-muted smaller">
                                            Repositório: {!! $usuario->repositorio->nome !!}</div>
                                    @else
                                        <div class="text-muted smaller">Repositório: Nenhuma</div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </a>
                </td>
                <td>

                    @if(Auth::user()->email==='jeancarlospenas25@gmail.com' || Auth::user()->tipo==='Administrador')
                        @if(!empty($rota_edicao))
                            @include('componentes.link',['id' => $usuario->codusuario, 'rota' => $rota_edicao])
                        @endif
                        @include('componentes.link',['id' => $usuario->codusuario, 'rota' => 'edit_vinculo','edite_vinculo' => 'true'])
                    @endif

                    @if(($usuario->tipo!=='Administrador' && $usuario->email!=='jeancarlospenas25@gmail.com' && Auth::user()->tipo==='Administrador')|| Auth::user()->email==='jeancarlospenas25@gmail.com')
                        @if(!empty($rota_exclusao))
                            @include('componentes.form_delete',['id' => $usuario->codusuario, 'rota' => $rota_exclusao])
                        @endif
                    @endif

                    @if(!empty($rota_exibicao))
                        @include('componentes.link',['id' => $usuario->codusuario, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
                    @endif

                    @if(Auth::user()->email==='jeancarlospenas25@gmail.com' || Auth::user()->tipo==='Administrador')
                        @if(!empty($usuario->repositorio))
                            @includeIf('componentes.form_desvincular',[
                            'id' => $usuario->codusuario
                            ])
                        @endif
                    @endif
                </td>
            @else
                @if($usuario->email!=='jeancarlospenas25@gmail.com')
                    <td>
                        <a href="{!! route($rota_edicao,[$usuario->codusuario]) !!}">
                            <div class="media">

                                <img class="d-flex mr-3 rounded-circle" src="{{ Gravatar::src($usuario->email) }}"
                                     alt=""
                                     width="100">
                                @if(Auth::user()->tipo==='Administrador' && Auth::user()->email!=='jeancarlospenas25@gmail.com')
                                    <div class="media-body">

                                        <strong>{!!  $usuario->name !!}</strong>
                                        @if(!empty($usuario->tipo))
                                            <div class="text-muted smaller">Tipo: {!! $usuario->tipo !!}</div>
                                        @else
                                            <div class="text-muted smaller">Tipo: Padrão</div>
                                        @endif
                                        @if(!empty($usuario->repositorio))
                                            <div class="text-muted smaller">
                                                Repositório: {!! $usuario->repositorio->nome !!}</div>
                                        @else
                                            <div class="text-muted smaller">Repositório: Nenhuma</div>
                                        @endif


                                    </div>
                                @elseif(Auth::user()->email==='jeancarlospenas25@gmail.com')
                                    <div class="media-body">
                                        <strong>{!!  $usuario->name !!}</strong>

                                        <div class="text-muted smaller">Tipo: {!! $usuario->tipo !!}</div>

                                        <div class="text-muted smaller">Email: {!! $usuario->email !!}</div>

                                        @if(!empty($usuario->repositorio))
                                            <div class="text-muted smaller">
                                                Repositório: {!! $usuario->repositorio->nome !!}</div>
                                        @else
                                            <div class="text-muted smaller">Repositório: Nenhuma</div>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </a>
                    </td>
                    <td>

                        @if(Auth::user()->email==='jeancarlospenas25@gmail.com' || Auth::user()->tipo==='Administrador')
                            @if(!empty($rota_edicao))
                                @include('componentes.link',['id' => $usuario->codusuario, 'rota' => $rota_edicao])

                            @endif
                        @endif

                        @if(($usuario->tipo!=='Administrador' && $usuario->email!=='jeancarlospenas25@gmail.com' && Auth::user()->tipo==='Administrador')|| Auth::user()->email==='jeancarlospenas25@gmail.com')
                            @if(!empty($rota_exclusao))
                                @include('componentes.form_delete',['id' => $usuario->codusuario, 'rota' => $rota_exclusao])
                            @endif
                        @endif

                        @if(!empty($rota_exibicao))
                            @include('componentes.link',['id' => $usuario->codusuario, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
                        @endif

                        @if(Auth::user()->email==='jeancarlospenas25@gmail.com' || Auth::user()->tipo==='Administrador')
                            @if(!empty($usuario->repositorio))
                                @includeIf('componentes.form_desvincular',[
                                'id' => $usuario->codusuario
                                ])
                            @endif

                        @endif
                    </td>
                @endif
            @endif
        </tr>
    @endforeach
    </tbody>
@endif
