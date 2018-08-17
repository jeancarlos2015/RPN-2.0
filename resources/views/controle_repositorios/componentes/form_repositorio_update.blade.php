<form action="{!! route('controle_repositorios.update',[$repositorio->codrepositorio]) !!}" method="POST">
    @method('PUT')
    @csrf
    @includeIf('controle_repositorios.form',['acao' => 'Atualizar e Proseguir','dados' => $dados,'MAX' => 2])
</form>