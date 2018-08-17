
@includeIf('controle_repositorios.componentes.campos')

@if(empty($repositorio))
    @includeIf('componentes.botao_sim_nao',[
    'name' => 'visibilidade',
    'pergunta' => 'Deseja tornar este registro visível para todos os usuários?',
    ])
    @includeIf('componentes.botao_sim_nao',[
    'name' => 'publico',
    'pergunta' => 'Deseja publicar este projeto?',
    ])
@else
    @includeIf('componentes.botao_sim_nao',[
    'name' => 'visibilidade',
    'pergunta' => 'Deseja tornar este registro visível para todos os usuários?',
    'objeto' => $repositorio
    ])
    @includeIf('componentes.botao_sim_nao',[
    'name' => 'publico',
    'pergunta' => 'Deseja publicar este repositório no site?',
    'objeto' => $repositorio
    ])
@endif

<button type="submit" class="btn btn-dark form-control">{!! $acao !!}</button>

