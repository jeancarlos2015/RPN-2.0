@includeIf('controle_projetos.componentes.campos')
@if(!empty($codrepositorio))
    <input type="hidden" name="cod_repositorio" class="form-control"
           value="{!! $codrepositorio !!}">
@endif

@if(!empty($usuarios))
    <div class="form-group">
        <label>Usuario</label>

        <select class="selectpicker form-control" name="codusuario">
            @foreach($usuarios as $usuario)
                <option value="{!! $usuario->codusuario !!}">{!! $usuario->name !!}</option>
            @endforeach
        </select>

    </div>
@endif

@if(!empty($projetos))
    <div class="form-group">
        <label>Projeto</label>

        <select class="selectpicker form-control" name="cod_projeto">
            @foreach($projetos as $projeto)
                <option value="{!! $projeto->cod_projeto !!}">{!! $projeto->nome !!}</option>
            @endforeach
        </select>

    </div>
@endif
<button type="submit" class="btn btn-dark form-control">{!! $acao !!}</button>
