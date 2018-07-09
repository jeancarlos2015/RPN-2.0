{!! csrf_field() !!}
    @foreach($dados as $dado)
        <div class="form-group">
            @if($dado->campo!=="Ações")
                <label>{!! $dado->campo !!}</label>
                <input name="{!! $dado->atributo !!}" class="form-control" placeholder="{!! $dado->campo !!}" value="{!! $dado->valor !!}">
            @endif
        </div>
    @endforeach
    <button type="submit" class="btn btn-primary form-control">{!! $acao !!}</button>
