{{--qt_parametros é a quantidade de parametros que está sendo passado na instrução include--}}
@if(!empty($qt_parametros))
    @if($qt_parametros==2)
        {{--Este trecho acontece quando está sendo listado os projetos--}}
        <a class="btn btn-primary"
           href="{!! route($rota_criacao,[$parametro1 => $organizacao_id]) !!}">{!! $botao !!}</a>

    @elseif($qt_parametros==4)
        {{--Este trecho acontece quando está sendo listado os modelos--}}
        <a class="btn btn-primary"
           href="{!! route($rota_criacao,[$parametro1 => $organizacao_id, $parametro2 => $projeto_id]) !!}">{!! $botao !!}</a>
    @elseif($qt_parametros==5)
        {{--Este trecho acontece quando está sendo listado os modelos--}}
        <a class="btn btn-primary"
           href="{!! route($rota_criacao,[
                                $parametro1 => $organizacao_id,
                                $parametro2 => $projeto_id,
                                $parametro3 => $modelo_id
                                ]) !!}">{!! $botao !!}</a>
        @if(!empty($tarefas) && count($tarefas)>1)
            <a class="btn btn-dark" href="{!! route('controle_regras_create',[
                                $parametro1 => $organizacao_id,
                                $parametro2 => $projeto_id,
                                $parametro3 => $modelo_id
            ]) !!}">Criar Regras</a>
        @endif
    @endif
@else
    {{--Este trecho acontece quando está sendo listado as organizações--}}
    <a class="btn btn-primary" href="{!! route($rota_criacao) !!}">{!! $botao !!}</a>
@endif


<table class="table">
    <thead>
    <tr>
        @foreach($titulos as $titulo)
            <th scope="col">{!! $titulo !!}</th>
        @endforeach
    </tr>
    </thead>
    <tbody class="text-left">

    @foreach($dados as $dado)
        <tr>
            @include('componentes.dados_regras',['dado' => $dado])
            <td>
                <div class="ordena">
                    <ul>
                        <li>
                            @include('componentes.link',['id' => $dado->id, 'rota' => $rota_edicao])
                        </li>
                        <li>
                            @include('componentes.form_delete',['id' => $dado->id, 'rota' => $rota_exclusao])
                        </li>
                    </ul>
                </div>


            </td>
        </tr>
    @endforeach
    </tbody>
</table>