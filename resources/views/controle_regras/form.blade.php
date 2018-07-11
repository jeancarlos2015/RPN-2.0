{!! csrf_field() !!}
@for($indice=0;$indice<$MAX;$indice++)
    <div class="form-group">
        @if(($dados[$indice]->campo!=="Ações") && !isset($dados[$indice]->value))
            @if($dados[$indice]->campo!=="Operador" && $dados[$indice]->campo!=="Nome da Regra")
                <label>{!! $dados[$indice]->campo !!}</label>

                <select name="{!! $dados[$indice]->atributo !!}" class="form-control">
                    @foreach($tarefas as $tarefa)
                        <option value="{!! $tarefa->id !!}">{!! $tarefa->nome !!}</option>
                    @endforeach
                </select>

            @else
                <label>{!! $dados[$indice]->campo !!}</label>
                <input name="{!! $dados[$indice]->atributo !!}" class="form-control"
                       placeholder="{!! $dados[$indice]->campo !!}" value="{!! $dados[$indice]->valor !!}" required>
            @endif

        @endif
    </div>
@endfor

@if(!empty($organizacao_id))
    <input type="hidden" name="organizacao_id" class="form-control"
           value="{!! $organizacao_id !!}">
@endif

@if(!empty($projeto_id))
    <input type="hidden" name="projeto_id" class="form-control"
           value="{!! $projeto_id !!}">
@endif

@if(!empty($modelo_id))
    <input type="hidden" name="modelo_id" class="form-control"
           value="{!! $modelo_id !!}">
@endif


<button type="submit" class="btn btn-primary form-control">{!! $acao !!}</button>