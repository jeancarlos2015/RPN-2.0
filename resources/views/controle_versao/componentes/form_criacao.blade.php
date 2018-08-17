<form action="{!! route('criar_base') !!}" method="post">
    @csrf
    <div class="form-group">
        <label>Nome da Base</label>
        <input type="text" name="nome" class="form-control" required>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-dark form-control" value="Criar Base">
    </div>
</form>