<form action="{!! route('controle_documentacoes.store') !!}" method="post">
    @method('POST')
    @csrf
    @includeIf('controle_documentacao.form',['acao' => 'Criar Documentação','dados' => $dados,'MAX' => 3])
</form>