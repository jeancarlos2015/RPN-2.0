
@if(Auth::user()->email==='jeancarlospenas25@gmail.com' || Auth::user()->tipo==='Administrador')
    <div class="card form-group">
        @includeIf('controle_usuario.componente.edicao_de_usuarios')
    </div>
@endif
