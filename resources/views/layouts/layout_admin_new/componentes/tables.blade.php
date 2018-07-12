<!-- Example DataTables Card-->
<div class="card mb-3">
    <div class="card-header">
        @if(!empty($titulo))
            <i class="fa fa-table"></i> {!! $titulo !!}
        @endif
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    @if(!empty($titulos))
                        @foreach($titulos as $titulo1)
                            <th>{!! $titulo1 !!}</th>
                        @endforeach
                    @endif
                </tr>
                </thead>

                <tfoot>
                <tr>
                    @if(!empty($titulos))
                        @foreach($titulos as $titulo1)
                            <th>{!! $titulo1 !!}</th>
                        @endforeach
                    @endif
                </tr>
                </tfoot>
                @if(!empty($modelos))
                    <tbody>
                    @foreach($modelos as $modelo1)
                        <tr>
                            <td>{!! $modelo1->codmodelo !!}</td>
                            <td>{!! $modelo1->nome !!}</td>
                            <td>{!! $modelo1->descricao !!}</td>
                            <td>{!! $modelo1->tipo !!}</td>
                            <td>

                                @if(!empty($rota_edicao))
                                    @include('componentes.link',['id' => $modelo1->codmodelo, 'rota' => $rota_edicao])
                                @endif
                                @if(!empty($rota_exclusao))
                                    @include('componentes.form_delete',['id' => $modelo1->codmodelo, 'rota' => $rota_exclusao])
                                @endif
                                @if(!empty($rota_exibicao))
                                    @include('componentes.link',['id' => $modelo1->codmodelo, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                @endif

                @if(!empty($projetos))
                    <tbody>
                    @foreach($projetos as $projeto1)
                        <tr>
                            <td>{!! $projeto1->codprojeto !!}</td>
                            <td>{!! $projeto1->nome !!}</td>
                            <td>{!! $projeto1->descricao !!}</td>
                            @if(!empty($projeto1->organizacao->nome))
                                <td>{!! $projeto1->organizacao->nome !!}</td>
                            @else
                                <td>Foi Removido/Não Informado</td>
                            @endif
                            <td>
                                @if(!empty($rota_edicao))
                                    @include('componentes.link',['id' => $projeto1->codprojeto, 'rota' => $rota_edicao])
                                @endif
                                @if(!empty($rota_exclusao))
                                    @include('componentes.form_delete',['id' => $projeto1->codprojeto, 'rota' => $rota_exclusao])
                                @endif
                                @if(!empty($rota_exibicao))
                                    @include('componentes.link',['id' => $projeto1->codprojeto, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
                                @endif

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                @endif

                @if(!empty($organizacoes))
                    <tbody>
                    @foreach($organizacoes as $organizacao1)
                        <tr>
                            <td>{!! $organizacao1->codorganizacao !!}</td>
                            <td>{!! $organizacao1->nome !!}</td>
                            <td>{!! $organizacao1->descricao !!}</td>
                            <td>
                                @if(!empty($rota_edicao))
                                    @include('componentes.link',['id' => $organizacao1->codorganizacao, 'rota' => $rota_edicao])
                                @endif
                                @if(!empty($rota_exclusao))
                                    @include('componentes.form_delete',['id' => $organizacao1->codorganizacao, 'rota' => $rota_exclusao])
                                @endif
                                @if(!empty($rota_exibicao))
                                    @include('componentes.link',['id' => $organizacao1->codorganizacao, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                @endif

                @if(!empty($regras))
                    <tbody>
                    @foreach($regras as $regra1)
                        <tr>
                            <td>{!! $regra1->codregra !!}</td>
                            <td>{!! $regra1->tarefas[0]->nome !!}</td>
                            <td>{!! $regra1->operador !!}</td>
                            <td>{!! $regra1->tarefas[1]->nome !!}</td>
                            <td>

                                @if(!empty($rota_edicao))
                                    @include('componentes.link',['id' => $regra1->codregra, 'rota' => $rota_edicao])
                                @endif
                                @if(!empty($rota_exclusao))
                                    @include('componentes.form_delete',['id' => $regra1->codregra, 'rota' => $rota_exclusao])
                                @endif
                                @if(!empty($rota_exibicao))
                                    @include('componentes.link',['id' => $regra1->codregra, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
                                @endif

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                @endif

                @if(!empty($tarefas))
                    <tbody>
                    @foreach($tarefas as $tarefa1)
                        <tr>
                            <td>{!! $tarefa1->codtarefa !!}</td>
                            <td>{!! $tarefa1->nome !!}</td>
                            <td>{!! $tarefa1->descricao !!}</td>
                            <td>

                                @if(!empty($rota_edicao))
                                    @include('componentes.link',['id' => $tarefa1->codtarefa, 'rota' => $rota_edicao])
                                @endif
                                @if(!empty($rota_exclusao))
                                    @include('componentes.form_delete',['id' => $tarefa1->codtarefa, 'rota' => $rota_exclusao])
                                @endif
                                @if(!empty($rota_exibicao))
                                    @include('componentes.link',['id' => $tarefa1->codtarefa, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
                                @endif

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                @endif
            </table>
        </div>
    </div>
    <div class="card-footer small text-muted">Teste</div>
</div>