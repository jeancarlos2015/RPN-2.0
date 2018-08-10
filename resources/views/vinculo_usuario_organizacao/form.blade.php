<div class="form-group">
    <label>Organizações</label>
    <select class="selectpicker form-control" name="codorganizacao">
        @foreach($organizacoes as $organizacao)
            <option value="{!! $organizacao->codorganizacao !!}">{!! $organizacao->nome !!}</option>
        @endforeach
    </select>
</div>
<div class="form-group">

        <input type="text" value="{!! $usuario->name !!}" class="form-control" disabled />

</div>

<input type="hidden" value="{!! $usuario->codusuario !!}" name="codusuario"/>

<button type="submit" class="btn btn-dark form-control">Vincular Usuário</button>