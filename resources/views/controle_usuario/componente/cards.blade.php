<div class="card form-group card-box">
    @includeIf('controle_usuario.componente.vinculacao_usuarios')
</div>
@if(Auth::user()->email==='jeancarlospenas25@gmail.com' || Auth::user()->tipo==='Administrador')
    <div class="card form-group">
        @includeIf('controle_usuario.componente.edicao_de_usuarios')
    </div>
@endif
