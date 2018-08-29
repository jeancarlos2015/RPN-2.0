@if(!empty($tipo))
    @switch($tipo)
        @case ('repositorio')
        <div class="form-group">
            <a class="btn btn-dark form-control"
               href="{!! route('controle_repositorios.create') !!}">Novo Repositório</a>
        </div>

        @break;

        @case ('modelo_diagramatico')
        <div class="form-group">
            <a class="btn btn-dark form-control"
               href="{!! route('controle_modelos_diagramaticos_create',[

                        'cod_repositorio' => $repositorio->cod_repositorio,
                        'cod_projeto' => $projeto->cod_projeto

                        ]) !!}">Novo Modelo BPMN</a>
        </div>

        @break;
        @case ('modelo_declarativo')
        <div class="form-group">
            <a class="btn btn-danger form-control"
               href="{!! route('controle_modelos_declarativos_create',[

                        'cod_repositorio' => $repositorio->cod_repositorio,
                        'cod_projeto' => $projeto->cod_projeto

                        ]) !!}">Novo Modelo Declarativo</a>
        </div>

        @break;
        @case ('objetofluxo')
        <div class="form-group">
            <a class="btn btn-dark form-control"
               href="{!! route('controle_objetos_fluxos_create',[$modelo_declarativo->cod_modelo_declarativo]) !!}">Novo Objeto de Fluxo</a>
        </div>


        @break;
        @case ('usuario')
        <div class="form-group">
            <a class="btn btn-dark form-control"
               href="{!! route('controle_usuarios.create') !!}">Novo Usuário</a>
        </div>

        @break;

        @case ('projeto')
        <div class="form-group">
            <a class="btn btn-dark form-control"
               href="{!! route('controle_projetos_create',['organizacao_id' => $repositorio->cod_repositorio]) !!}">Novo
                Projeto</a>
        </div>

        @break;
        @case ('documentacao')
        <div class="form-group">
            <a class="btn btn-dark form-control"
               href="{!! route('controle_documentacoes.create')!!}">Nova
                Documentação</a>
        </div>

        @break;
        @case ('regra')
        @if(!empty($modelo_declarativo))
            @includeIf('controle_modelos_declarativos.controle_objetos_fluxo.componentes.links_padroes_recomendacao')
        @endif
        @break;
    @endswitch


@endif
