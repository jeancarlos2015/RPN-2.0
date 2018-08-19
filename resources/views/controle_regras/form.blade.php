@includeIf('controle_regras.componentes.campos')
@if(!empty($codrepositorio))
    <input type="hidden" name="codrepositorio" class="form-control"
           value="{!! $codrepositorio !!}">
@endif

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


<button type="submit" class="btn btn-dark form-control">{!! $acao !!}</button>
