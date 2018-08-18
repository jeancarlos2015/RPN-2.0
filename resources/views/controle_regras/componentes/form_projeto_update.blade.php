<form action="{!! route('controle_projetos.update',['id' => $projeto->codprojeto]) !!}" method="post">
    @method('PUT')
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