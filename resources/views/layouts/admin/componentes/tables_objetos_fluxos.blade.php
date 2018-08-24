@if(!empty($objetos_fluxos))
    <tbody>
    @foreach($objetos_fluxos as $objeto)
        <tr>
            <td>
                @if(Auth::user()->email===$objeto->usuario->email)
                    <a href="{!! route($rota_edicao,[$objeto->codobjetofluxo]) !!}">
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
                                <div class="text-muted smaller">Projeto de origem: {!! $objeto->projeto->nome !!}</div>
                            @endif
                            @if(!empty($objeto->modelo->nome))
                                <div class="text-muted smaller">Modelo declarativo de
                                    origem: {!! $objeto->modelo->nome !!}</div>
                            @endif
                        </div>
                    </div>

                @endif

            </td>

            <td>
                @if(Auth::user()->email===$objeto->usuario->email)
                    @if(!empty($rota_edicao))
                        @include('componentes.link',['id' => $objeto->codobjetofluxo, 'rota' => $rota_edicao])
                    @endif
                    @if(!empty($rota_exclusao))
                        @include('componentes.form_delete',['id' => $objeto->codobjetofluxo, 'rota' => $rota_exclusao])
                    @endif
                @else
                    Nenhuma Ação
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
@endif