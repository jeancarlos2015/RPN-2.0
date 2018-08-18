<div class="subject-info-box-1">
    <select multiple="multiple" id='sbOne' class="form-control" name="sbOne[]">
        @foreach($objetos_fluxos as $objeto)
            <option value="{!! $objeto->codobjetofluxo !!}">{!! $objeto->nome !!}</option>
        @endforeach

    </select>
</div>