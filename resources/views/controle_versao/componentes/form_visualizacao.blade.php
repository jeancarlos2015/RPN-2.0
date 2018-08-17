<div class="form-group">
    <label>Nome Da Base</label>
    <input type="text" class="form-control" value="{!! $repositorio['name'] !!}" disabled>
</div>

<div class="form-group">
    <label>Nome Do Usuário</label>
    <input type="text" class="form-control" value="{!! $repositorio['owner']['login'] !!}" disabled>
</div>

<div class="form-group">
    <label>Git Do Base/Repositório</label>
    <input type="text" class="form-control" value="{!! $repositorio['git_url'] !!}" disabled>
</div>