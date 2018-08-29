<form action="{!! route('controle_modelos_diagramaticos.update',['id' => $modelo->cod_modelo_diagramatico]) !!}" method="post">
    @method('PUT')
    @csrf
    @includeIf('controle_modelos_diagramaticos.form',
    [
    'acao' => 'Atualizar e Proseguir',
    'dados' => $dados,
    'MAX' => 2,
    'organizacao_id' => $repositorio->cod_repositorio,
    'projeto_id' => $projeto->cod_projeto
    ]
    )

</form>