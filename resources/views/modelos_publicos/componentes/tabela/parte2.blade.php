<div class="table-responsive table-dark">
    <table class="table table-dark" id="dataTable" width="100%" cellspacing="0">
        <thead>
        <tr>
            <th>Modelos BPMN</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>Modelos BPMN</th>
        </tr>
        </tfoot>
        <tbody>

        @foreach($modelos as $modelo1)
            <tr>
                <td>
                    <div class="card card-body text-left">
                        <a href="{!! route('visualizar_modelo_publico',[$modelo1->codmodelodiagramatico]) !!}">
                            <div class="media">
                                <img class="d-flex mr-3 rounded-circle"
                                     src="{{ Gravatar::src($modelo1->usuario->email) }}"
                                     alt="" width="60">
                                <div class="media-body">
                                    <strong>Modelo - {!!  $modelo1->nome !!}</strong>
                                    @if(!empty($modelo1->usuario->name))
                                        <div class="text-muted smaller">
                                            Responsável: {!! $modelo1->usuario->name !!}</div>
                                    @endif
                                    <div class="text-muted smaller">Descrição do
                                        Modelo: {!! $modelo1->descricao !!}</div>
                                    <div class="text-muted smaller">Tipo: {!! $modelo1->tipo !!}</div>
                                    @if(!empty($modelo1->projeto->nome ))
                                        <div class="text-muted smaller">
                                            Projeto: {!! $modelo1->projeto->nome !!}</div>
                                    @endif
                                    @if(!empty($modelo1->repositorio->nome ))
                                        <div class="text-muted smaller">

                                            Repositório: {!! $modelo1->repositorio->nome !!}
                                        </div>
                                    @endif
                                    <div class="text-muted smaller">
                                        Data da Criação: {!! $modelo1->created_at !!}</div>

                                </div>
                            </div>
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>