<form action="{!! route('controle_usuarios.store') !!}" method="post">
    @method('POST')
    @csrf
    @includeIf('controle_usuario.form',['acao' => 'Criar Usuário'])
</form>