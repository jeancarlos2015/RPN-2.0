<form action="{!! route('controle_modelos_declarativos.update',['controle_modelos_declarativo' => $modelo->cod_modelo_diagramatico]) !!}" method="put">
    @csrf
    @method('PUT')
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