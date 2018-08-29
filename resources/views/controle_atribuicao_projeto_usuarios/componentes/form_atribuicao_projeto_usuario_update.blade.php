<form action="{!! route('controle_atribuicao_projeto_usuarios.update',['id' => $atribuicao_projeto_usuario->$codatribuicaoprojetousuario]) !!}" method="post">
    @method('PUT')
    @csrf
    @includeIf('controle_projetos.form',
                                    [
                                    'acao' => 'Salvar e Proseguir',
                                    'dados' => $dados,
                                    'MAX' => 2,
                                    'cod_repositorio' => $repositorio->cod_repositorio
                                    ]
                                    )
</form>