{{--{!! csrf_field() !!}--}}
{{--@for($indice=0;$indice<$MAX;$indice++)--}}
    {{--<div class="form-group">--}}
        {{--@if(($dados[$indice]->campo!=="Ações") && !isset($dados[$indice]->value))--}}

            {{--@if($dados[$indice]->campo!=='Visibilidade')--}}
                {{--<label>{!! $dados[$indice]->campo !!}</label>--}}
                {{--<input type="{!! $dados[$indice]->type !!}" class="form-control"--}}
                       {{--name="{!! $dados[$indice]->atributo !!}" placeholder="{!! $dados[$indice]->campo !!}"--}}
                       {{--value="{!! $dados[$indice]->valor !!}" required>--}}
            {{--@else--}}
                {{--<input type="{!! $dados[$indice]->type !!}"--}}
                       {{--name="{!! $dados[$indice]->atributo !!}" placeholder="{!! $dados[$indice]->campo !!}"--}}
                       {{--value="{!! $dados[$indice]->valor !!}" title="Ao clicar neste ítem todos os usuários poderão manipulá-lo">--}}
                {{--<label>{!! $dados[$indice]->campo !!}</label>--}}
            {{--@endif--}}

        {{--@endif--}}
    {{--</div>--}}
{{--@endfor--}}

{{--@if(!empty($codrepositorio))--}}
    {{--<input type="hidden" name="codrepositorio" class="form-control"--}}
           {{--value="{!! $codrepositorio !!}">--}}
{{--@endif--}}

{{--@if(!empty($codprojeto))--}}
    {{--<input type="hidden" name="codprojeto" class="form-control"--}}
           {{--value="{!! $codprojeto !!}">--}}
{{--@endif--}}

{{--@if(!empty($codmodelo))--}}
    {{--<input type="hidden" name="codmodelo" class="form-control"--}}
           {{--value="{!! $codmodelo !!}">--}}
{{--@endif--}}
{{--<div class="form-group">--}}
    {{--<label class="control-label" for="votou">Deseja tornar este registro visível para todos os usuários?</label>--}}
    {{--<div class="controls">--}}
        {{--<input name="votou" type="hidden" value="0">--}}
        {{--<label class="switch-light switch-candy">--}}
            {{--<input type="checkbox" name="votou"--}}
                   {{--value="1" {!! !empty($tarefa->visibilidade) ? ($tarefa->visibilidade ? 'checked' : '') : '' !!}>--}}
            {{--<span>--}}
                {{--<span>Não <i class='fa fa-thumbs-down'></i></span>--}}
                {{--<span>Sim <i class='fa fa-thumbs-up'></i></span>--}}
            {{--<a></a>--}}
          {{--</span>--}}
        {{--</label>--}}
    {{--</div>--}}
{{--</div>--}}
{{--<button type="submit" class="btn btn-dark form-control">{!! $acao !!}</button>--}}
