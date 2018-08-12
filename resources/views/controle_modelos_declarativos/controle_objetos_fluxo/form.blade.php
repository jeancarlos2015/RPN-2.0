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
                       value="{!! $dados[$indice]->valor !!}"
                       title="Ao clicar neste ítem todos os usuários poderão manipulá-lo" required>
                <label>{!! $dados[$indice]->campo !!}</label>
            @endif

        @endif
    </div>
@endfor

<div class="form-group">
    <label>Tipo</label>
    <select class="selectpicker form-control" name="tipo">
        @foreach($tipos as $tipo)
            <option value="{!! $tipo !!}">{!! $tipo!!}</option>
        @endforeach
    </select>
</div>


{{--'codrepositorio',--}}
{{--'codusuario',--}}
{{--'codprojeto',--}}
{{--'codmodelodeclarativo',--}}

<input type="hidden" value="{!! $modelo_declarativo->codrepositorio !!}" name="codrepositorio">
<input type="hidden" value="{!! $modelo_declarativo->codusuario !!}" name="codusuario">
<input type="hidden" value="{!! $modelo_declarativo->codprojeto !!}" name="codprojeto">
<input type="hidden" value="{!! $modelo_declarativo->codmodelodeclarativo !!}" name="codmodelodeclarativo">

{{--'visivel_projeto',--}}
{{--'visivel_modelo_declarativo',--}}
{{--'visivel_repositorio'--}}


<div class="form-group">
    <label class="control-label" for="visibilidade">Deseja tornar este registro visível em outros Projetos?</label>
    <div class="controls">
        <input name="visivel_projeto" type="hidden" value="false">
        <label class="switch-light switch-candy">
            <input type="checkbox" name="visivel_projeto"
                   value="true" {!! !empty($objeto_fluxo->visivel_projeto) ? ($objeto_fluxo->visivel_projeto ? 'checked' : '') : '' !!}>
            <span>
                <span>Não <i class='fa fa-thumbs-down'></i></span>
                <span>Sim <i class='fa fa-thumbs-up'></i></span>
            <a></a>
          </span>
        </label>
    </div>
</div>

<div class="form-group">
    <label class="control-label" for="visibilidade">Deseja tornar este registro visível em outros Modelos
        Declarativos?</label>
    <div class="controls">
        <input name="visivel_modelo_declarativo" type="hidden" value="false">
        <label class="switch-light switch-candy">
            <input type="checkbox" name="visivel_modelo_declarativo"
                   value="true" {!! !empty($objeto_fluxo->visivel_modelo_declarativo) ? ($objeto_fluxo->visivel_modelo_declarativo ? 'checked' : '') : '' !!}>
            <span>
                <span>Não <i class='fa fa-thumbs-down'></i></span>
                <span>Sim <i class='fa fa-thumbs-up'></i></span>
            <a></a>
          </span>
        </label>
    </div>
</div>

<div class="form-group">
    <label class="control-label" for="visibilidade">Deseja tornar este registro visível em outros Repositórios?</label>
    <div class="controls">
        <input name="visivel_modelo_declarativo" type="hidden" value="false">
        <label class="switch-light switch-candy">
            <input type="checkbox" name="visivel_modelo_declarativo"
                   value="true" {!! !empty($objeto_fluxo->visivel_repositorio) ? ($objeto_fluxo->visivel_repositorio ? 'checked' : '') : '' !!}>
            <span>
                <span>Não <i class='fa fa-thumbs-down'></i></span>
                <span>Sim <i class='fa fa-thumbs-up'></i></span>
            <a></a>
          </span>
        </label>
    </div>
</div>

<button type="submit" class="btn btn-dark form-control">{!! $acao !!}</button>
