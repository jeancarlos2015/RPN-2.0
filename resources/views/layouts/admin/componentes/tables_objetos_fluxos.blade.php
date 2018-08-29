@if(!empty($objetos_fluxos))
    <tbody>
    @foreach($objetos_fluxos as $objeto)
        <tr>
            <td>
                @if(!empty($objeto->usuario) && Auth::user()->email===$objeto->usuario->email || Auth::user()->tipo==='Administrador' || Auth::user()->email==='jeancarlospenas25@gmail.com')
                    <a href="{!! route($rota_edicao,[$objeto->cod_objeto_fluxo]) !!}">
                        <div class="media">
                            <img class="d-flex mr-3 rounded-circle" src="{{ Gravatar::src($objeto->usuario->email) }}"
                                 alt="" width="50">
                            <div class="media-body">
                                <strong>{!!  $objeto->nome !!}</strong>
                                <div class="text-muted smaller">Objeto de fluxo: {!! $objeto->nome !!}</div>

                                <div class="text-muted smaller">Tipo: {!! $objeto->tipo !!}</div>
                                @if(!empty($objeto->usuario->name))
                                    <div class="text-muted smaller">Responsável: {!! $objeto->usuario->name !!}</div>
                                @endif
                                <div class="text-muted smaller">Descrição: {!! $objeto->descricao !!}</div>
                                @if(!empty($objeto->repositorio->nome))
                                    <div class="text-muted smaller">Repositório de
                                        origem: {!! $objeto->repositorio->nome !!}</div>
                                @endif
                                @if(!empty($objeto->projeto->nome))
                                    <div class="text-muted smaller">Projeto de
                                        origem: {!! $objeto->projeto->nome !!}</div>
                                @endif
                                @if(!empty($objeto->modelo->nome))
                                    <div class="text-muted smaller">Modelo declarativo de
                                        origem: {!! $objeto->modelo->nome !!}</div>
                                @endif

                            </div>
                        </div>
                    </a>
                @else
                    @if(!empty($objeto->usuario) && Auth::user()->email===$objeto->usuario->email || Auth::user()->tipo==='Administrador' || Auth::user()->email==='jeancarlospenas25@gmail.com')
                        <div class="media">
                            <img class="d-flex mr-3 rounded-circle" src="{{ Gravatar::src($objeto->usuario->email) }}"
                                 alt="" width="100">
                            <div class="media-body">

                                <strong>{!!  $objeto->nome !!}</strong>
                                <div class="text-muted smaller">Objeto de fluxo: {!! $objeto->nome !!}</div>

                                <div class="text-muted smaller">Tipo: {!! $objeto->tipo !!}</div>
                                <div class="text-muted smaller">Responsável: {!! $objeto->usuario->name !!}</div>
                                <div class="text-muted smaller">Descrição: {!! $objeto->descricao !!}</div>
                                @if(!empty($objeto->repositorio->nome))
                                    <div class="text-muted smaller">Repositório de
                                        origem: {!! $objeto->repositorio->nome !!}</div>
                                @endif
                                @if(!empty($objeto->projeto->nome))
                                    <div class="text-muted smaller">Projeto de
                                        origem: {!! $objeto->projeto->nome !!}</div>
                                @endif
                                @if(!empty($objeto->modelo->nome))
                                    <div class="text-muted smaller">Modelo declarativo de
                                        origem: {!! $objeto->modelo->nome !!}</div>
                                @endif
                            </div>
                        </div>
                    @endif

                @endif

            </td>

            <td>
                @if((!empty($objeto->usuario) && Auth::user()->email===$objeto->usuario->email) || (Auth::user()->tipo==='Administrador' || Auth::user()->email==='jeancarlospenas25@gmail.com'))
                    @if(!empty($rota_edicao))
                        @include('componentes.link',['id' => $objeto->cod_objeto_fluxo, 'rota' => $rota_edicao])
                    @endif
                    @if(!empty($rota_exclusao))
                        @include('componentes.form_delete',['id' => $objeto->cod_objeto_fluxo, 'rota' => $rota_exclusao])
                    @endif
                @else
                    Nenhuma Ação
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
@endif