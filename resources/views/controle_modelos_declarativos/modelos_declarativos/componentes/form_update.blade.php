<form action="{!! route('controle_modelos_diagramaticos.update',['id' => $modelo->codmodelodiagramatico]) !!}" method="post">
    @method('PUT')
    @csrf
    @includeIf('controle_modelos_diagramaticos.form',
    [
    'acao' => 'Atualizar e Proseguir',
    'dados' => $dados,
    'MAX' => 2,
    'organizacao_id' => $repositorio->codrepositorio,
    'projeto_id' => $projeto->codprojeto
    ]
    )

</form>