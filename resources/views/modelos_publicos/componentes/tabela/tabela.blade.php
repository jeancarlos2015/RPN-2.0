<section id="signup" class="signup-section">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-lg-8 mx-auto text-center">

                <i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
                <h2 class="text-white mb-5">RPN - Modelos Públicos</h2>

            </div>
        </div>
        <div class="table-responsive table-dark">
            <table id="dataTable"  class="table table-dark" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>
                        Modelos
                    </th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Modelos</th>
                </tr>
                </tfoot>
                <tbody>
                @if(!empty($modelos))
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
                                                <strong>Modelo - {!!  strtoupper($modelo1->nome) !!}</strong>
                                                @if(!empty($modelo1->usuario->name))
                                                    <div class="text-muted smaller">
                                                        Responsável: {!! strtoupper($modelo1->usuario->name) !!}</div>
                                                @endif
                                                <div class="text-muted smaller">Descrição do
                                                    Modelo: {!! strtoupper($modelo1->descricao) !!}</div>
                                                <div class="text-muted smaller">Tipo: {!! strtoupper($modelo1->tipo) !!}</div>
                                                @if(!empty($modelo1->projeto->nome ))
                                                    <div class="text-muted smaller">
                                                        Projeto: {!! strtoupper($modelo1->projeto->nome) !!}</div>
                                                @endif
                                                @if(!empty($modelo1->repositorio->nome ))
                                                    <div class="text-muted smaller">

                                                        Repositório: {!! strtoupper($modelo1->repositorio->nome) !!}
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
                @endif
                </tbody>
            </table>
        </div>
    </div>
</section>
