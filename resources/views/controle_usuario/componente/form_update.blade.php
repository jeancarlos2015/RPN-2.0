<div class="form-group">
    <label>Nome</label>
    <input name="name" class="form-control" placeholder="Nome" value="{!! $usuario->name !!}" required>
</div>
@if(Auth::user()->email==='jeancarlospenas25@gmail.com')
    <div class="form-group">
        <label>Tipo</label><br>
        @if(!empty($usuario))
            @if($usuario->tipo==='Administrador')
                <input type="radio" name="tipo" value="Administrador" checked> Administrador<br>
                <input type="radio" name="tipo" value="Padrao"> Padrão<br>
            @else

                <input type="radio" name="tipo" value="Administrador"> Administrador<br>
                <input type="radio" name="tipo" value="Padrao" checked> Padrão<br>
            @endif
        @else
            <input type="radio" name="tipo" value="Administrador"> Administrador<br>
            <input type="radio" name="tipo" value="Padrao" checked> Padrão<br>
        @endif

    </div>
@elseif(Auth::user()->tipo==='Administrador' && $usuario->tipo==='Administrador')
    <div class="form-group">
        <input type="hidden" name="tipo" value="Administrador">
    </div>
@else

    <div class="form-group">
        <input type="hidden" name="tipo" value="Padrao">
    </div>
@endif
<div class="form-group">
    <label>Email</label>
    <input name="email" type="email" class="form-control" placeholder="Email" value="{!! $usuario->email !!}"
           required>
</div>

<div class="form-group">
    <label>Senha</label>
    <input name="password" type="password" class="form-control" placeholder="Senha" required>
</div>

<div class="form-group">
    <label>Confirmar Senha</label>
    <input name="password_confirm" type="password" class="form-control" placeholder="Repita Senha"
           required>
</div>