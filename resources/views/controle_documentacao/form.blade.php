@includeIf('controle_documentacao.componentes.campos')

@if(empty($documentacao))
    @includeIf('componentes.botao_sim_nao',[
    'pergunta' => 'Deseja tornar este registro visível para todos os usuários?',
    'name' => 'visibilidade'
    ])
@else
    @includeIf('componentes.botao_sim_nao',[
    'pergunta' => 'Deseja tornar este registro visível para todos os usuários?',
    'objeto' => $documentacao,
    'name' => 'visibilidade'
    ])
@endif

<button type="submit" class="btn btn-dark form-control">{!! $acao !!}</button>

