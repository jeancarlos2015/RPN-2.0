{{--{!! csrf_field() !!}--}}
{{--@for($indice=0;$indice<$MAX;$indice++)--}}
    {{--<div class="form-group">--}}
        {{--@if(($dados[$indice]->campo!=="Ações") && !isset($dados[$indice]->value))--}}
            {{--@if($dados[$indice]->campo!=="Operador" && $dados[$indice]->campo!=="Nome da Regra")--}}
                {{--<label>{!! $dados[$indice]->campo !!}</label>--}}

                {{--<select name="{!! $dados[$indice]->atributo !!}" class="form-control">--}}
                    {{--@foreach($tarefas as $tarefa)--}}
                        {{--<option value="{!! $tarefa->codtarefa !!}">{!! $tarefa->nome !!}</option>--}}
                    {{--@endforeach--}}
                {{--</select>--}}

            {{--@else--}}
                {{--<label>{!! $dados[$indice]->campo !!}</label>--}}
                {{--<input name="{!! $dados[$indice]->atributo !!}" class="form-control"--}}
                       {{--placeholder="{!! $dados[$indice]->campo !!}" value="{!! $dados[$indice]->valor !!}" required>--}}
            {{--@endif--}}

        {{--@endif--}}
    {{--</div>--}}
{{--@endfor--}}

{{--@if(!empty($repositorio))--}}
    {{--<input type="hidden" name="codrepositorio" class="form-control"--}}
           {{--value="{!! $repositorio->codrepositorio !!}">--}}
{{--@endif--}}

{{--@if(!empty($projeto))--}}
    {{--<input type="hidden" name="codprojeto" class="form-control"--}}
           {{--value="{!! $projeto->codprojeto !!}">--}}
{{--@endif--}}

{{--@if(!empty($modelo))--}}
    {{--<input type="hidden" name="codmodelo" class="form-control"--}}
           {{--value="{!! $modelo->codmodelo !!}">--}}
{{--@endif--}}

{{--<div class="form-group">--}}
    {{--<label class="control-label" for="votou">Deseja tornar este registro visível para todos os usuários?</label>--}}
    {{--<div class="controls">--}}
        {{--<input name="votou" type="hidden" value="0">--}}
        {{--<label class="switch-light switch-candy">--}}
            {{--<input type="checkbox" name="votou"--}}
                   {{--value="1" {!! !empty($regra->visibilidade) ? ($regra->visibilidade ? 'checked' : '') : '' !!}>--}}
            {{--<span>--}}
                {{--<span>Não <i class='fa fa-thumbs-down'></i></span>--}}
                {{--<span>Sim <i class='fa fa-thumbs-up'></i></span>--}}
            {{--<a></a>--}}
          {{--</span>--}}
        {{--</label>--}}
    {{--</div>--}}
{{--</div>--}}
{{--<button type="submit" class="btn btn-dark form-control">{!! $acao !!}</button>--}}