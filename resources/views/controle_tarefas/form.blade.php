{!! csrf_field() !!}
@for($indice=0;$indice<$MAX;$indice++)
    <div class="form-group">
        @if(($dados[$indice]->campo!=="Ações"))
            <label>{!! $dados[$indice]->campo !!}</label>
            <input name="{!! $dados[$indice]->atributo !!}" class="form-control" placeholder="{!! $dados[$indice]->campo !!}" value="{!! $dados[$indice]->valor !!}" required>
        @endif
    </div>
@endfor

@if(!empty($codorganizacao))
    <input type="hidden" name="codorganizacao" class="form-control"
           value="{!! $codorganizacao !!}">
@endif

@if(!empty($codprojeto))
    <input type="hidden" name="codprojeto" class="form-control"
           value="{!! $codprojeto !!}">
@endif

@if(!empty($codmodelo))
    <input type="hidden" name="codmodelo" class="form-control"
           value="{!! $codmodelo !!}">
@endif

<button type="submit" class="btn btn-dark form-control">{!! $acao !!}</button>
