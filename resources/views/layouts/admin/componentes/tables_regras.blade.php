@if(!empty($regras))
    <tbody>

    @foreach($regras as $regra)
        <tr>
            {{--<td>{!! $regra->coddocumentacao !!}</td>--}}
            {{--<td>{!! $regra->nome !!}</td>--}}
            {{--<td>{!! $regra->descricao !!}</td>--}}
            <td>
                @if(!empty($rota_edicao))
                    <a href="{!! route($rota_exibicao,[$regra->codregra]) !!}">
                        <div class="media">
                            <img class="d-flex mr-3 rounded-circle" src="{{ Gravatar::src($regra->usuario->email) }}"
                                 alt="" width="100">
                            <div class="media-body">
                                <strong>{!! $regra->usuario->name !!}</strong>
                                <div class="text-muted smaller">Código da Regra: {!! $regra->codregra !!}</div>
                                <div class="text-muted smaller">Nome da Regra: {!! $regra->nome !!} </div>
                                <div class="text-muted smaller">Responsável: {!! $regra->usuario->name !!}</div>
                                <div class="text-muted smaller">Descrição do
                                    Modelo: {!! $regra->modelodeclarativo->descricao !!}</div>
                                <div class="text-muted smaller">Projeto: {!! $regra->projeto->nome !!}</div>
                                <div class="text-muted smaller">Repositório: {!! $regra->repositorio->nome !!}</div>
                            </div>
                        </div>
                    </a>
                @else
                    <a href="#">
                        <div class="media">
                            <img class="d-flex mr-3 rounded-circle" src="{{ Gravatar::src($regra->usuario->email) }}"
                                 alt="" width="100">
                            <div class="media-body">
                                <strong>{!! $regra->usuario->name !!}</strong>
                                <div class="text-muted smaller">Descrição da Regra: {!! $regra->nome !!}</div>
                                <div class="text-muted smaller">Modelo
                                    Declarativo:: {!! $regra->modelodeclarativo->nome !!}</div>
                                <div class="text-muted smaller">Responsável: {!! $regra->usuario->name !!}</div>
                                <div class="text-muted smaller">Descrição do
                                    Modelo: {!! $regra->modelodeclarativo->descricao !!}</div>
                                <div class="text-muted smaller">Projeto: {!! $regra->projeto->nome !!}</div>
                                <div class="text-muted smaller">Repositório: {!! $regra->repositorio->nome !!}</div>
                            </div>
                        </div>
                    </a>
                @endif


            </td>

            <td>
                @if(Auth::user()->email===$regra->usuario->email)
                    @if(!empty($rota_edicao))
                        @include('componentes.link',['id' => $regra->coddocumentacao, 'rota' => $rota_edicao])
                    @endif

                    @if(!empty($rota_exclusao))
                        @include('componentes.form_delete',['id' => $regra->coddocumentacao, 'rota' => $rota_exclusao])
                    @endif
                    @if(!empty($rota_exibicao))
                        @include('componentes.link',
                        [
                        'id' => $regra->coddocumentacao,
                        'rota' => $rota_exibicao
                        ]
                        )
                    @endif
                @else
                    @if(!empty($rota_exibicao))
                        @include('componentes.link',
                        [
                        'id' => $regra->codregra,
                        'rota' => $rota_exibicao,
                        'nomebotao' => 'Visualizar'
                        ]
                        )
                    @endif
                @endif


            </td>
        </tr>
    @endforeach
    </tbody>
@endif
