<div class="form-group">
    <label>Repositórios</label>
    <select class="selectpicker form-control" name="cod_repositorio">
        @foreach($repositorios as $repositorio)
            <option value="{!! $repositorio->cod_repositorio !!}">{!! $repositorio->nome !!}</option>
        @endforeach
    </select>
</div>
<div class="form-group">

        <input type="text" value="{!! $usuario->name !!}" class="form-control" disabled />

</div>

<input type="hidden" value="{!! $usuario->codusuario !!}" name="codusuario"/>
<input type="hidden" value="true" name="vinculo">
<button type="submit" class="btn btn-dark form-control">Vincular Usuário</button>