<div class="col-12">
    <div class="subject-info-box-1">
        @if(!empty($multi))
            <select multiple="multiple" id='sbOne' class="form-control" name="sbOne[]">
                @foreach($objetos_fluxos as $objeto)
                    <option value="{!! $objeto->codobjetofluxo !!}">{!! $objeto->nome !!}</option>
                @endforeach
            </select>
            @else
            <select id='sbOne' class="form-control" name="sbOne[]">
                @foreach($objetos_fluxos as $objeto)
                    <option value="{!! $objeto->codobjetofluxo !!}">{!! $objeto->nome !!}</option>
                @endforeach

            </select>
        @endif
    </div>

</div>