
@includeIf('controle_modelos_diagramaticos.componentes.campos')

@if(empty($modelo))
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
    'objeto' => $modelo
    ])
    @includeIf('componentes.botao_sim_nao',[
    'name' => 'publico',
    'pergunta' => 'Deseja publicar este modelo?',
    'objeto' => $modelo
    ])
@endif
<button type="submit" class="btn btn-dark form-control">{!! $acao !!}</button>