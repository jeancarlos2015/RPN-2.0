<form action="{!! route('controle_modelos_declarativos.update',['controle_modelos_declarativo' => $modelo->codmodelodiagramatico]) !!}" method="put">
    @csrf
    @method('PUT')
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