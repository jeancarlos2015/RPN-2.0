@if(!empty($tipo))
    @switch($tipo)
        @case ('organizacao')
        <a class="btn btn-dark form-control"
           href="{!! route('controle_organizacoes.create') !!}">Nova Organização</a>
        @break;

        @case ('modelo')
        <a class="btn btn-dark form-control"
           href="{!! route('controle_modelos_create',[

                        'organizacao_id' => $organizacao->id,
                        'projeto_id' => $projeto->id

                        ]) !!}">Novo Modelo</a>
        @break;

        @case ('regra')
        <a class="btn btn-dark form-control"
           href="{!! route('controle_regras_create',
                [
                'organizacao_id' => $organizacao->id,
                     'projeto_id' => $projeto->id,
                       'modelo_id' => $modelo->id
                ]
           ) !!}">Nova Regra</a>

        @break;

        @case ('tarefa')
        @if(count($tarefas)>1)

            <a class="btn btn-dark form-control"
               href="{!! route('controle_regras_create',
                [
                'organizacao_id' => $organizacao->id,
                     'projeto_id' => $projeto->id,
                       'modelo_id' => $modelo->id
                ]
           ) !!}">Nova Regra</a>
            <br>
            <br>
            <br>
        @endif
        <a class="btn btn-dark form-control"
           href="{!! route('controle_tarefas_create',
           [
                    'organizacao_id' => $organizacao->id,
                     'projeto_id' => $projeto->id,
                       'modelo_id' => $modelo->id
           ]
           ) !!}">Nova Tarefa</a>
        @break;

        @case ('projeto')
        <a class="btn btn-dark form-control"
           href="{!! route('controle_projetos_create',['organizacao_id' => $organizacao->id]) !!}">Novo Projeto</a>
        @break;

    @endswitch


@endif