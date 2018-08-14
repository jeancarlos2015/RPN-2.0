<script src="{!! asset('jquery_select/jquery-1.11.1.min.js') !!}"></script>


<div class="row">
    <div class="col-5">
        <div class="subject-info-box-1">
            <select multiple="multiple" id='sbOne' class="form-control" name="sbOne[]">
                @foreach($objetos_fluxos as $objeto)
                    <option value="{!! $objeto->codobjetofluxo !!}">{!! $objeto->nome !!}</option>
                @endforeach

            </select>
        </div>

    </div>
    <div class="col-2">
        <div class="subject-info-arrows text-center">
            <input type='button' id='rightall' value='>>' class="btn btn-default"/><br/>
            <input type='button' id='right' value='>' class="btn btn-default"/><br/>
            <input type='button' id='left' value='<' class="btn btn-default"/><br/>
            <input type='button' id='leftall' value='<<' class="btn btn-default"/>
        </div>
    </div>

    <div class="col-5">
        <div class="subject-info-box-2">
            <select multiple="multiple" id='sbTwo' class="form-control" name="sbTwo[]">
                {{--<option value="asp">ASP.NET</option>--}}
                {{--<option value="c#">C#</option>--}}
            </select>
        </div>
    </div>


</div>


<div class="form-group">
    <label>Tipo de Padrão de Recomendação</label>
    <select class="selectpicker form-control" name="relacionamento">
        <option value="2">Não Coexistência</option>
        <option value="3">União</option>
        <option value="4">Independência</option>
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
                   value="true" {!! !empty($regra->visivel_projeto) ? ($regra->visivel_projeto ? 'checked' : '') : '' !!}>
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
                   value="true" {!! !empty($regra->visivel_modelo_declarativo) ? ($regra->visivel_modelo_declarativo ? 'checked' : '') : '' !!}>
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
                   value="true" {!! !empty($regra->visivel_repositorio) ? ($regra->visivel_repositorio ? 'checked' : '') : '' !!}>
            <span>
                <span>Não <i class='fa fa-thumbs-down'></i></span>
                <span>Sim <i class='fa fa-thumbs-up'></i></span>
            <a></a>
          </span>
        </label>
    </div>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark form-control">Aplicar Regra</button>
</div>


<script>
    $(function () {
        function moveItems(origin, dest) {
            $(origin).find(':selected').appendTo(dest);
        }

        function moveAllItems(origin, dest) {
            $(origin).children().appendTo(dest);
        }

        $('#left').click(function () {
            moveItems('#sbTwo', '#sbOne');
        });

        $('#right').on('click', function () {
            moveItems('#sbOne', '#sbTwo');
        });

        $('#leftall').on('click', function () {
            moveAllItems('#sbTwo', '#sbOne');
        });

        $('#rightall').on('click', function () {
            moveAllItems('#sbOne', '#sbTwo');
        });
    });
</script>
