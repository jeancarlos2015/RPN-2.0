<section id="signup" class="signup-section">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-lg-8 mx-auto text-center">

                <i class="far fa-paper-plane fa-2x mb-2 text-white"></i>
                <h2 class="text-white mb-5">Busca de Modelos BPMN</h2>
                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Busca por Nome..">
            </div>
        </div>
        <div class="row">
            @php
                $contador = 0;
            @endphp

            <ul id="myUL" class="float">

                @foreach($modelos as $modelo1)
                    <li class="float-item">
                        <div class="card card-body text-left">
                            <a href="{!! route('visualizar_modelo_publico',[$modelo1->codmodelodiagramatico]) !!}">
                                <div class="media">
                                    <img class="d-flex mr-3 rounded-circle"
                                         src="{{ Gravatar::src($modelo1->usuario->email) }}"
                                         alt="" width="60">
                                    <div class="media-body">
                                        <strong>Modelo - {!!  $modelo1->nome !!}</strong>
                                        <div class="text-muted smaller">
                                            Responsável: {!! $modelo1->usuario->name !!}</div>
                                        <div class="text-muted smaller">Descrição do
                                            Modelo: {!! $modelo1->descricao !!}</div>
                                        <div class="text-muted smaller">Tipo: {!! $modelo1->tipo !!}</div>
                                        <div class="text-muted smaller">
                                            Projeto: {!! $modelo1->projeto->nome !!}</div>
                                        <div class="text-muted smaller">
                                            Repositório: {!! $modelo1->repositorio->nome !!}</div>

                                        <div class="text-muted smaller">
                                            Data da Criação: {!! $modelo1->created_at !!}</div>

                                    </div>
                                </div>
                            </a>
                        </div>
                    </li>
                    {{--@if($contador==3)--}}
                    {{--{!! $contador = 0; !!}--}}
                    {{--@break--}}
                    {{--@endif--}}
                    {{--@php--}}
                    {{--$contador++--}}
                    {{--@endphp--}}
                @endforeach

            </ul>


        </div>
    </div>
</section>