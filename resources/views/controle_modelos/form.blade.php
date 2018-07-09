{!! csrf_field() !!}
@for($indice=0;$indice<$MAX;$indice++)
    <div class="form-group">
        @if(($dados[$indice]->campo!=="Ações") && !isset($dados[$indice]->value))
            <label>{!! $dados[$indice]->campo !!}</label>
            <input name="{!! $dados[$indice]->atributo !!}" class="form-control"
                   placeholder="{!! $dados[$indice]->campo !!}" value="{!! $dados[$indice]->valor !!}">
        @endif
    </div>
@endfor

@if(!empty($dados[2]->valor))
    @if($dados[2]->valor == 'declarativo')
        <div class="form-group">
            <input type="radio" name="tipo" value="diagramatico"> Modelo Diagramatico
        </div>
        <div class="form-group">
            <input type="radio" name="tipo" value="declarativo" checked>Modelo Declarativo
        </div>
    @else
        <div class="form-group">
            <input type="radio" name="tipo" value="diagramatico" checked> Modelo Diagramatico
        </div>
        <div class="form-group">
            <input type="radio" name="tipo" value="declarativo">Modelo Declarativo
        </div>
    @endif
@else
    <div class="form-group">
        <input type="radio" name="tipo" value="diagramatico"> Modelo Diagramatico
    </div>
    <div class="form-group">
        <input type="radio" name="tipo" value="declarativo">Modelo Declarativo
    </div>
@endif


@if(!empty($organizacao_id))
    <input type="hidden" name="organizacao_id" class="form-control"
           value="{!! $organizacao_id !!}">
@endif

@if(!empty($projeto_id))
    <input type="hidden" name="projeto_id" class="form-control"
           value="{!! $projeto_id !!}">
@endif


<button type="submit" class="btn btn-primary form-control">{!! $acao !!}</button>