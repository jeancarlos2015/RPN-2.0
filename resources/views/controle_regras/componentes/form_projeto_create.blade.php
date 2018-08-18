<form action="{!! route('controle_projetos.store') !!}" method="post">
    @method('POST')
    @csrf
    @includeIf('controle_projetos.form',
    [
    'acao' => 'Salvar e Proseguir',
    'dados' => $dados,
    'MAX' => 2,
    'codrepositorio' => $repositorio->codrepositorio
    ]
    )
</form>