<form action="{!! route('controle_documentacoes.update',[$documentacao->coddocumentacao]) !!}" method="POST">
    @method('PUT')
    @csrf
    @includeIf('controle_documentacao.form',['acao' => 'Atualizar','dados' => $dados,'MAX' => 3])
</form>