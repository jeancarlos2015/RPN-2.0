<div class="form-group">
    <label>Organizações</label>
    <select class="selectpicker form-control" name="codorganizacao">
        @foreach($organizacoes as $organizacao)
            <option value="{!! $organizacao->codorganizacao !!}">{!! $organizacao->nome !!}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>Usuários</label>
    <select class="selectpicker form-control" name="codusuario">
        @foreach($usuarios as $usuario)
            <option value="{!! $usuario->codusuario !!}">{!! $usuario->name !!}</option>
        @endforeach
    </select>

</div>

<button type="submit" class="btn btn-dark form-control">Vincular Usuário</button>