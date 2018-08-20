<div class="card-header">
    <h4><strong>Edição De Usuário</strong></h4>
</div>

<form action="{!! route('controle_usuarios.update',['id' => $usuario->codusuario]) !!}" method="post"
      class="card-body">
    @csrf
    @method('PUT')
    @includeIf('controle_usuario.form',
    [
    'acao' => 'Atualizar',
    'usuario' => $usuario,
    'dados' => $dados,
    'codusuario' => $usuario->codusuario
    ])
</form>