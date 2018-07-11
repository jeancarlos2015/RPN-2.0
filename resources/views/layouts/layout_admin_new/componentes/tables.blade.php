<!-- Example DataTables Card-->
<div class="card mb-3">
    <div class="card-header">
        @if(!empty($titulo))
            <i class="fa fa-table"></i> {!! $titulo !!}
        @endif
    </div>

    @if(!empty($rota_cricao))
        @if(!empty($projetos) &&
            !empty($organizacao) &&
            !empty($modelo) &&
            !empty($tarefa) &&
            !empty($regra))
            <a class="btn btn-primary"
               href="{!! route($rota_criacao,['organizacao_id' => $organizacao->id]) !!}">Novo</a>
        @endif
    @endif



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
                            <td>{!! $modelo1->id !!}</td>
                            <td>{!! $modelo1->nome !!}</td>
                            <td>{!! $modelo1->descricao !!}</td>
                            <td>{!! $modelo1->tipo !!}</td>
                            <td>{!! $modelo1->tipo !!}</td>
                            <td>

                                @if(!empty($rota_edicao))
                                    @include('componentes.link',['id' => $modelo1->id, 'rota' => $rota_edicao])
                                @endif
                                @if(!empty($rota_exclusao))
                                    @include('componentes.form_delete',['id' => $modelo1->id, 'rota' => $rota_exclusao])
                                @endif
                                @if(!empty($rota_exibicao))
                                    @include('componentes.link',['id' => $modelo1->id, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
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
                            <td>{!! $projeto1->id !!}</td>
                            <td>{!! $projeto1->nome !!}</td>
                            <td>{!! $projeto1->descricao !!}</td>
                            <td>{!! $projeto1->organizacao->nome !!}</td>
                            <td>
                                @if(!empty($rota_edicao))
                                    @include('componentes.link',['id' => $projeto1->id, 'rota' => $rota_edicao])
                                @endif
                                @if(!empty($rota_exclusao))
                                    @include('componentes.form_delete',['id' => $projeto1->id, 'rota' => $rota_exclusao])
                                @endif
                                @if(!empty($rota_exibicao))
                                    @include('componentes.link',['id' => $projeto1->id, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
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
                            <td>{!! $organizacao1->id !!}</td>
                            <td>{!! $organizacao1->nome !!}</td>
                            <td>{!! $organizacao1->descricao !!}</td>
                            <td>
                                @if(!empty($rota_edicao))
                                    @include('componentes.link',['id' => $organizacao1->id, 'rota' => $rota_edicao])
                                @endif
                                @if(!empty($rota_exclusao))
                                    @include('componentes.form_delete',['id' => $organizacao1->id, 'rota' => $rota_exclusao])
                                @endif
                                @if(!empty($rota_exibicao))
                                    @include('componentes.link',['id' => $organizacao1->id, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
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
                            <td>{!! $regra1->id !!}</td>
                            <td>{!! $regra1->tarefa1 !!}</td>
                            <td>{!! $regra1->operador !!}</td>
                            <td>{!! $regra1->tarefa2 !!}</td>
                            <td>

                                @if(!empty($rota_edicao))
                                    @include('componentes.link',['id' => $regra1->id, 'rota' => $rota_edicao])
                                @endif
                                @if(!empty($rota_exclusao))
                                    @include('componentes.form_delete',['id' => $regra1->id, 'rota' => $rota_exclusao])
                                @endif
                                @if(!empty($rota_exibicao))
                                    @include('componentes.link',['id' => $regra1->id, 'rota' => $rota_exibicao,'nomebotao' => 'Visualizar'])
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
                            <td>{!! $tarefa1->id !!}</td>
                            <td>{!! $tarefa1->nome !!}</td>
                            <td>{!! $tarefa1->descricao !!}</td>
                            <td>Excluir | Visualizar | Editar</td>
                        </tr>
                    @endforeach
                    </tbody>
                @endif
            </table>
        </div>
    </div>
    <div class="card-footer small text-muted">Teste</div>
</div>