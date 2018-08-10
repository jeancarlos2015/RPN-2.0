{!! csrf_field() !!}
@for($indice=0;$indice<$MAX;$indice++)
    <div class="form-group">
        @if(($dados[$indice]->campo!=="Ações") && !isset($dados[$indice]->value))

            @if($dados[$indice]->campo!=='Visibilidade')
                <label>{!! $dados[$indice]->campo !!}</label>
                <input type="{!! $dados[$indice]->type !!}" class="form-control"
                       name="{!! $dados[$indice]->atributo !!}" placeholder="{!! $dados[$indice]->campo !!}"
                       value="{!! $dados[$indice]->valor !!}" required>
            @else
                <input type="{!! $dados[$indice]->type !!}"
                       name="{!! $dados[$indice]->atributo !!}" placeholder="{!! $dados[$indice]->campo !!}"
                       value="{!! $dados[$indice]->valor !!}" title="Ao clicar neste ítem todos os usuários poderão manipulá-lo" required>
                <label>{!! $dados[$indice]->campo !!}</label>
            @endif

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

@if(!empty($codrepositorio))
    <input type="hidden" name="codrepositorio" class="form-control"
           value="{!! $codrepositorio !!}">
@endif

@if(!empty($codprojeto))
    <input type="hidden" name="codprojeto" class="form-control"
           value="{!! $codprojeto !!}">
@endif

<div class="form-group">
    <label class="control-label" for="visibilidade">Deseja tornar este registro visível para todos os usuários?</label>
    <div class="controls">
        <input name="visibilidade" type="hidden" value="false">
        <label class="switch-light switch-candy">
            <input type="checkbox" name="visibilidade"
                   value="true" {!! !empty($modelo->visibilidade) ? ($modelo->visibilidade ? 'checked' : '') : '' !!}>
            <span>
                <span>Não <i class='fa fa-thumbs-down'></i></span>
                <span>Sim <i class='fa fa-thumbs-up'></i></span>
            <a></a>
          </span>
        </label>
    </div>
</div>

<div class="form-group">
    <label class="control-label" for="publico">Deseja publicar este modelo?</label>
    <div class="controls">
        <input name="publico" type="hidden" value="false">
        <label class="switch-light switch-candy">
            <input type="checkbox" name="publico"
                   value="true" {!! !empty($modelo->publico) ? ($modelo->publico ? 'checked' : '') : '' !!}>
            <span>
                <span>Não <i class='fa fa-thumbs-down'></i></span>
                <span>Sim <i class='fa fa-thumbs-up'></i></span>
            <a></a>
          </span>
        </label>
    </div>
</div>
<button type="submit" class="btn btn-dark form-control">{!! $acao !!}</button>