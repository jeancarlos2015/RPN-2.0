<form action="{!! route('controle_modelos_declarativos.store') !!}" method="post">
    @csrf
    @includeIf('controle_modelos_declarativos.modelos_declarativos.form',
    [
    'acao' => 'Salvar e Proseguir',
    'dados' => $dados,
    'MAX' => 2,
    'codrepositorio' => $repositorio->codrepositorio,
    'codprojeto' => $projeto->codprojeto
    ])
</form>