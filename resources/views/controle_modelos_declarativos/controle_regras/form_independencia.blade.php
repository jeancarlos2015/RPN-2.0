<div class="form-group">
    <label>Conjunto de Atividades/Eventos</label>

</div>

<div class="form-group">
    <label>Tipo Relacionamento</label>
    <select class="selectpicker form-control" name="relacionamento">
        <option value="0">Dependencia Estrita</option>
        <option value="1">Dependencia Circunstancia</option>
        <option value="2">Não Coexistência</option>
        <option value="3">União</option>
        <option value="4">Independência</option>
    </select>
</div>
rg
<div class="form-group">
    <label>Conjunto de Atividades/Eventos</label>
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
<div class="form-group">
    <button type="submit" class="btn btn-dark form-control">Criar Regra</button>
</div>

