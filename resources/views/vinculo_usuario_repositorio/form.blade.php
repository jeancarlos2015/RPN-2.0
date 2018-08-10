<div class="form-group">
    <label>Repositórios</label>
    <select class="selectpicker form-control" name="codrepositorio">
        @foreach($repositorios as $repositorio)
            <option value="{!! $repositorio->codrepositorio !!}">{!! $repositorio->nome !!}</option>
        @endforeach
    </select>
</div>
<div class="form-group">

        <input type="text" value="{!! $usuario->name !!}" class="form-control" disabled />

</div>

<input type="hidden" value="{!! $usuario->codusuario !!}" name="codusuario"/>

<button type="submit" class="btn btn-dark form-control">Vincular Usuário</button>