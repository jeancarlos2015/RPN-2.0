@includeIf('controle_modelos_declarativos.controle_objetos_fluxo.componentes.campos')

@if(empty($objeto_fluxo))
    @includeIf('controle_modelos_declarativos.controle_objetos_fluxo.componentes.botao_sim_nao',[
    'pergunta' => 'Deseja tornar este registro visível em outros Projetos?',
    'name' => 'visivel_projeto'
    ])

    @includeIf('controle_modelos_declarativos.controle_objetos_fluxo.componentes.botao_sim_nao',[
    'pergunta' => 'Deseja tornar este registro visível em outros Modelos
        Declarativos?',
    'name' => 'visivel_modelo_declarativo'
    ])
@else
    @includeIf('controle_modelos_declarativos.controle_objetos_fluxo.componentes.botao_sim_nao',[
    'pergunta' => 'Deseja tornar este registro visível em outros Projetos?',
    'name' => 'visivel_projeto',
    'visivel' => $objeto_fluxo->visivel_projeto
    ])

    @includeIf('controle_modelos_declarativos.controle_objetos_fluxo.componentes.botao_sim_nao',[
    'pergunta' => 'Deseja tornar este registro visível em outros Modelos
        Declarativos?',
    'name' => 'visivel_modelo_declarativo',
    'visivel' => $objeto_fluxo->visivel_modelo_declarativo
    ])
@endif
<div class="form-group">
    <button type="submit" class="btn btn-dark form-control">{!! $acao !!}</button>
</div>
