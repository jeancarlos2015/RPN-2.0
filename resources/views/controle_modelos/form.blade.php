{!! csrf_field() !!}
@for($indice=0;$indice<$MAX;$indice++)
    <div class="form-group">
        @if(($dados[$indice]->campo!=="Ações") && !isset($dados[$indice]->value))
            <label>{!! $dados[$indice]->campo !!}</label>
            <input name="{!! $dados[$indice]->atributo !!}" class="form-control"
                   placeholder="{!! $dados[$indice]->campo !!}" value="{!! $dados[$indice]->valor !!}" required>
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
<div class="form-group">
    <input id="checkbox-signup" type="checkbox" checked="checked" name="visibilidade">
    <label class="control-label" for="checkbox-signup">Visível para outros usuários</label>
</div>

@if(!empty($codorganizacao))
    <input type="hidden" name="codorganizacao" class="form-control"
           value="{!! $codorganizacao !!}">
@endif

@if(!empty($codprojeto))
    <input type="hidden" name="codprojeto" class="form-control"
           value="{!! $codprojeto !!}">
@endif


<button type="submit" class="btn btn-dark form-control">{!! $acao !!}</button>