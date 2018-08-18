@includeIf('controle_projetos.componentes.campos')
@if(!empty($codrepositorio))
    <input type="hidden" name="codrepositorio" class="form-control"
           value="{!! $codrepositorio !!}">
@endif
@if(empty($projeto))
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
    'objeto' => $projeto
    ])
    @includeIf('componentes.botao_sim_nao',[
    'name' => 'publico',
    'pergunta' => 'Deseja publicar este projeto?',
    'objeto' => $projeto
    ])
@endif
<button type="submit" class="btn btn-dark form-control">{!! $acao !!}</button>
