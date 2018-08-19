@includeIf('controle_regras.componentes.campos')
@if(!empty($codrepositorio))
    <input type="hidden" name="codrepositorio" class="form-control"
           value="{!! $codrepositorio !!}">
@endif
@if(empty($regra))

@else

@endif
<button type="submit" class="btn btn-dark form-control">{!! $acao !!}</button>
