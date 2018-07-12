{!! csrf_field() !!}
@for($indice=0;$indice<$MAX;$indice++)
    <div class="form-group">
        @if(($dados[$indice]->campo!=="Ações") && !isset($dados[$indice]->value))
            @if($dados[$indice]->campo!=="Operador" && $dados[$indice]->campo!=="Nome da Regra")
                <label>{!! $dados[$indice]->campo !!}</label>

                <select name="{!! $dados[$indice]->atributo !!}" class="form-control">
                    @foreach($tarefas as $tarefa)
                        <option value="{!! $tarefa->codtarefa !!}">{!! $tarefa->nome !!}</option>
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

@if(!empty($organizacao))
    <input type="hidden" name="codorganizacao" class="form-control"
           value="{!! $organizacao->codorganizacao !!}">
@endif

@if(!empty($projeto))
    <input type="hidden" name="codprojeto" class="form-control"
           value="{!! $projeto->codprojeto !!}">
@endif

@if(!empty($modelo))
    <input type="hidden" name="codmodelo" class="form-control"
           value="{!! $modelo->codmodelo !!}">
@endif


<button type="submit" class="btn btn-dark form-control">{!! $acao !!}</button>