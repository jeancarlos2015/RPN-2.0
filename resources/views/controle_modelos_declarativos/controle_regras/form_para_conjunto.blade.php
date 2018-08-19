@includeIf('controle_modelos_declarativos.controle_regras.componentes.campos',['multi' => 'true'])
@includeIf('controle_modelos_declarativos.controle_regras.componentes.select_padroes_conjunto')
@if(empty($regra))

    @includeIf('controle_modelos_declarativos.controle_regras.componentes.botao_sim_nao',
    [
    'pergunta' => 'Deseja tornar este registro visível em outros Projetos?',
    'name' => 'visivel_projeto'
    ])

    @includeIf('controle_modelos_declarativos.controle_regras.componentes.botao_sim_nao',
    [
    'pergunta' => 'Deseja tornar este registro visível em outros Modelos Declarativos?',
    'name' => 'visivel_modelo_declarativo'
    ])

    @includeIf('controle_modelos_declarativos.controle_regras.componentes.botao_sim_nao',
    [
    'pergunta' => 'Deseja tornar este registro visível em outros Repositórios?',
    'name' => 'visivel_repositorio'
    ])
@else
    @includeIf('controle_modelos_declarativos.controle_regras.componentes.botao_sim_nao',
   [
   'pergunta' => 'Deseja tornar este registro visível em outros Projetos?',
   'name' => 'visivel_projeto',
   'visivel' => $regra->visivel_projeto
   ])

    @includeIf('controle_modelos_declarativos.controle_regras.componentes.botao_sim_nao',
    [
    'pergunta' => 'Deseja tornar este registro visível em outros Modelos Declarativos?',
    'name' => 'visivel_modelo_declarativo',
    'visivel' => $regra->visivel_modelo_declarativo
    ])

    @includeIf('controle_modelos_declarativos.controle_regras.componentes.botao_sim_nao',
    [
    'pergunta' => 'Deseja tornar este registro visível em outros Repositórios?',
    'name' => 'visivel_repositorio',
    'visivel' => $regra->visivel_repositorio
    ])

@endif

<div class="form-group">
    <button type="submit" class="btn btn-dark form-control">Criar Regra</button>
</div>

@includeIf('controle_modelos_declarativos.controle_regras.componentes.script')
