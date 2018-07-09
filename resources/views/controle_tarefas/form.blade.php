{!! csrf_field() !!}
@for($indice=0;$indice<$MAX;$indice++)
    <div class="form-group">
        @if(($dados[$indice]->campo!=="Ações"))
            <label>{!! $dados[$indice]->campo !!}</label>
            <input name="{!! $dados[$indice]->atributo !!}" class="form-control" placeholder="{!! $dados[$indice]->campo !!}" value="{!! $dados[$indice]->valor !!}" required>
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
