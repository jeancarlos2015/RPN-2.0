<form action="{!! route('controle_modelos_diagramaticos.store') !!}" method="post">
    @method('POST')
    @csrf
    @includeIf('controle_modelos_diagramaticos.form',
    [
    'acao' => 'Salvar e Proseguir',
    'dados' => $dados,
    'MAX' => 2,
    'cod_repositorio' => $repositorio->cod_repositorio,
    'cod_projeto' => $projeto->cod_projeto
    ])
</form>