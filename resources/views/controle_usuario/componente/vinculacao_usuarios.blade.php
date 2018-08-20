<div class="card form-group card-box">
    <div class="card-header">
        <h4><strong>Vinculação De Usuário</strong></h4>
    </div>
    <form action="{!! route('vincular_usuario_repositorio') !!}" method="post">
        @method('POST')

        @csrf
        @includeIf('vinculo_usuario_repositorio.form',[
        'usuario' => $usuario,
        'repositorios' => $repositorios
        ])
    </form>

</div>