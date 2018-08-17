<form action="{!! route('controle_modelos_diagramaticos.store') !!}" method="post">
    @method('POST')
    @csrf
    @includeIf('controle_modelos_diagramaticos.form',
    [
    'acao' => 'Salvar e Proseguir',
    'dados' => $dados,
    'MAX' => 2,
    'codrepositorio' => $repositorio->codrepositorio,
    'codprojeto' => $projeto->codprojeto
    ])
</form>