@if(!empty(Auth::user()->github->branch_atual) && !empty(Auth::user()->github->repositorio_atual))
    @includeIf('menu.componentes.commit')

    @includeIf('menu.componentes.merge',[
    'titulo' => 'Juntar Ramificação',
    'componente' => '#collapseComponents10',
    'id' => 'collapseComponents10',
    'tipo' => 'merge',
    'nome_botao' => 'Executar',
    'rota' => 'merge_checkout',
    'descricao' => 'Este método faz o Merge(Juntar) da branch/Ramo ao qual a base de dados está relacionada'
    ])

    @includeIf('menu.componentes.merge',[
   'titulo' => 'Trocar Ramificação',
   'componente' => '#collapseComponents11',
   'id' => 'collapseComponents11',
   'tipo' => 'checkout',
   'nome_botao' => 'Executar',
   'rota' => 'merge_checkout',
   'descricao' => 'Este método faz o checkout(Troca) da branch/Ramo na qual a base de dados está relacionada'
   ])

    @includeIf('menu.componentes.create_delete',[
            'titulo' => 'Criar Ramificação',
            'componente' => '#collapseComponents7',
            'rota' => 'create',
            'nome_botao' => 'Criar',
            'descricao' => 'Este método criará uma branch no repositório da API de versionamento',
            'id' => 'collapseComponents7'
            ])

    @includeIf('menu.componentes.create_delete',[
    'titulo' => 'Excluir Ramificação',
    'componente' => '#collapseComponents8',
    'rota' => 'delete',
    'nome_botao' => 'Excluir Ramificação',
    'descricao' => 'Este método deletará uma branch no repositório da API de versionamento',
    'id' => 'collapseComponents8'
    ])
@endif