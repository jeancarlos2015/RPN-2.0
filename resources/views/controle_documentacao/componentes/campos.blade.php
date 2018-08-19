@for($indice=0;$indice<$MAX;$indice++)
    <div class="form-group">
        @if(($dados[$indice]->campo!=="Ações") && !isset($dados[$indice]->value))

            @if($dados[$indice]->campo!=='Visibilidade')
                <label>{!! $dados[$indice]->campo !!}</label>
                <input type="{!! $dados[$indice]->tipo !!}" class="form-control"
                       name="{!! $dados[$indice]->atributo !!}" placeholder="{!! $dados[$indice]->rotulo !!}"
                       value="{!! $dados[$indice]->valor !!}" required>
            @else
                <input type="{!! $dados[$indice]->tipo !!}"
                       name="{!! $dados[$indice]->atributo !!}" placeholder="{!! $dados[$indice]->rotulo !!}"
                       value="{!! $dados[$indice]->valor !!}"
                       title="Ao clicar neste ítem todos os usuários poderão manipulá-lo" required>
                <label>{!! $dados[$indice]->campo !!}</label>
            @endif

        @endif
    </div>
@endfor