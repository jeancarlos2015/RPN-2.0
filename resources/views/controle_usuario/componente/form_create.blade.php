<div class="form-group">
    <label>Nome</label>
    <input name="name" class="form-control" placeholder="Nome" required>
</div>

<div class="form-group">
    <label>Email</label>
    <input name="email" type="email" class="form-control" placeholder="Email" required>
</div>
@if(Auth::user()->email==='jeancarlospenas25@gmail.com')
    <div class="form-group">
        <label>Tipo</label><br>

        <input type="radio" name="tipo" value="Administrador"> Administrador<br>
        <input type="radio" name="tipo" value="Padrao" checked> Padrão<br>

    </div>
@else
    <input type="hidden" name="tipo" value="Padrao">
@endif
<div class="form-group">
    <label>Senha</label>
    <input name="password" type="password" class="form-control" placeholder="Senha" required>
</div>
<div class="form-group">
    <label>Confirmar Senha</label>
    <input name="password_confirm" type="password" class="form-control" placeholder="Repita Senha"
           required>
</div>
