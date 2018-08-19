<div class="form-group">
    <label class="control-label" for="{!! $name !!}">{!! $pergunta !!}</label>
    <div class="controls">
        <input name="{!! $name !!}" type="hidden" value="false">
        <label class="switch-light switch-candy">
            <input type="checkbox" name="{!! $name !!}"
                   value="true" {!! isset($visivel) ? ($visivel ? 'checked' : '') : '' !!}>
            <span>
                <span>Não <i class='fa fa-thumbs-down'></i></span>
                <span>Sim <i class='fa fa-thumbs-up'></i></span>
            <a></a>
          </span>
        </label>
    </div>
</div>