<form action="{!! route('controle_repositorios.store') !!}" method="post">
    @method('POST')
    @csrf
    @includeIf('controle_repositorios.form',
    [
    'acao' => 'Salvar e Proseguir',
    'dados' => $dados,
    'MAX' => 2
    ])
</form>