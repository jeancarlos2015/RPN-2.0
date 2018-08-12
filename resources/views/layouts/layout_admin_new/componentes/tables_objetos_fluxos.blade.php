@if(!empty($objetos_fluxos))
    <tbody>
    @foreach($objetos_fluxos as $objeto)
        <tr>
            <td>
                <a href="{!! route($rota_edicao,[$objeto->codobjetofluxo]) !!}">
                    <div class="media">
                        <img class="d-flex mr-3 rounded-circle" src="{{ Gravatar::src($objeto->usuario->email) }}"
                             alt="" width="100">
                        <div class="media-body">
                            <strong>{!!  $objeto->nome !!}</strong>
                            <div class="text-muted smaller">Objeto de fluxo: {!! $objeto->nome !!}</div>

                            <div class="text-muted smaller">Tipo: {!! $objeto->tipo !!}</div>
                            <div class="text-muted smaller">Responsável: {!! $objeto->usuario->name !!}</div>
                            <div class="text-muted smaller">Descrição: {!! $objeto->descricao !!}</div>
                            <div class="text-muted smaller">Repositório de origem: {!! $objeto->repositorio->nome !!}</div>
                            <div class="text-muted smaller">Projeto de origem: {!! $objeto->projeto->nome !!}</div>
                            <div class="text-muted smaller">Modelo declarativo de origem: {!! $objeto->modelo->nome !!}</div>
                        </div>
                    </div>
                </a>
            </td>

            <td>

                @if(!empty($rota_edicao))
                    @include('componentes.link',['id' => $objeto->codobjetofluxo, 'rota' => $rota_edicao])
                @endif
                @if(!empty($rota_exclusao))
                    @include('componentes.form_delete',['id' => $objeto->codobjetofluxo, 'rota' => $rota_exclusao])
                @endif

            </td>
        </tr>
    @endforeach
    </tbody>
@endif