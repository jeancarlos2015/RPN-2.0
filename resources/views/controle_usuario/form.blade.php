@if(!empty($usuario))

    <div class="form-group">
        <label>Nome</label>
        <input name="name" class="form-control" placeholder="Nome" value="{!! $usuario->name !!}" required>
    </div>

    <div class="form-group">
        <label>Tipo</label><br>

        <input type="radio" name="tipo" value="Administrador" checked> Administrador<br>
        <input type="radio" name="tipo" value="Padrao"> Padrão<br>

    </div>

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
@else

    <div class="form-group">
        <label>Nome</label>
        <input name="name" class="form-control" placeholder="Nome" value="teste" required>
    </div>

    <div class="form-group">
        <label>Email</label>
        <input name="email" type="email" class="form-control" placeholder="Email" value="teste@gmail.com" required>
    </div>

    <div class="form-group">
        <label>Senha</label>
        <input name="password" type="password" class="form-control" placeholder="Senha" value="senhasenha" required>
    </div>

    <div class="form-group">
        <label>Confirmar Senha</label>
        <input name="password_confirm" type="password" class="form-control" placeholder="Repita Senha"
               value="senhasenha"
               required>
    </div>




@endif
@if(Auth::user()->tipo==='administrador')
    <div class="form-group">
        <input type="radio" name="type" value="administrador" checked> Administrador
    </div>
    <div class="form-group">
        <input type="radio" name="type" value="padrao">Padrão
    </div>

@else
    <input type="hidden" name="type" value="padrao">
@endif

<button type="submit" class="btn btn-dark form-control">{!! $acao !!}</button>

