@if(!empty($tipo))
    @switch($tipo)
        @case ('organizacao')
        <a class="btn btn-dark form-control"
           href="{!! route('controle_organizacoes.create') !!}">Nova Organização</a>
        @break;

        @case ('modelo')
        <a class="btn btn-dark form-control"
           href="{!! route('controle_modelos_create',[

                        'organizacao_id' => $organizacao->codorganizacao,
                        'projeto_id' => $projeto->codprojeto

                        ]) !!}">Novo Modelo</a>
        @break;

        @case ('regra')
        <a class="btn btn-dark form-control"
           href="{!! route('controle_regras_create',
                [
                'organizacao_id' => $organizacao->codorganizacao,
                     'projeto_id' => $projeto->codprojeto,
                       'modelo_id' => $modelo->codmodelo
                ]
           ) !!}">Nova Regra</a>

        @break;

        @case ('tarefa')
        @if(count($tarefas)>1)

            <a class="btn btn-dark form-control"
               href="{!! route('controle_regras_create',
                [
                'organizacao_id' => $organizacao->codorganizacao,
                     'projeto_id' => $projeto->codprojeto,
                       'modelo_id' => $modelo->codmodelo
                ]
           ) !!}">Nova Regra</a>
            <br>
            <br>
            <br>
        @endif
        @case ('usuario')
        <a class="btn btn-dark form-control"
           href="{!! route('controle_usuarios.create') !!}">Novo Usuário</a>
        @break;

        @case ('projeto')
        <a class="btn btn-dark form-control"
           href="{!! route('controle_projetos_create',['organizacao_id' => $organizacao->codorganizacao]) !!}">Novo
            Projeto</a>
        @break;
        @case ('documentacao')
        <a class="btn btn-dark form-control"
           href="{!! route('controle_documentacoes.create')!!}">Nova
            Documentação</a>
        @break;
    @endswitch


@endif
