
@if(!empty($tipo))
    @switch($tipo)
        @case ('repositorio')
        <a class="btn btn-dark form-control"
           href="{!! route('controle_repositorios.create') !!}">Novo Repositório</a>
        @break;

        @case ('modelo')
        <a class="btn btn-dark form-control"
           href="{!! route('controle_modelos_create',[

                        'organizacao_id' => $repositorio->codrepositorio,
                        'projeto_id' => $projeto->codprojeto

                        ]) !!}">Novo Modelo</a>
        @break;

        @case ('regra')
        <a class="btn btn-dark form-control"
           href="{!! route('controle_regras_create',
                [
                'organizacao_id' => $repositorio->codrepositorio,
                     'projeto_id' => $projeto->codprojeto,
                       'modelo_id' => $modelo->codmodelo
                ]
           ) !!}">Nova Regra</a>

        @break;

        @case ('tarefa')
        {{--<a class="btn btn-dark form-control"--}}
           {{--href="{!! route('controle_tarefas_create',--}}
                {{--[--}}
                {{--'organizacao_id' => $repositorio->codrepositorio,--}}
                     {{--'projeto_id' => $projeto->codprojeto,--}}
                       {{--'modelo_id' => $modelo->codmodelo--}}
                {{--]--}}
           {{--) !!}">Nova ObjetoDeFluxo</a>--}}
        @if(count($tarefas)>1)

            {{--<a class="btn btn-dark form-control"--}}
               {{--href="{!! route('controle_regras_create',--}}
                {{--[--}}
                {{--'organizacao_id' => $repositorio->codrepositorio,--}}
                     {{--'projeto_id' => $projeto->codprojeto,--}}
                       {{--'modelo_id' => $modelo->codmodelo--}}
                {{--]--}}
           {{--) !!}">Nova Regra</a>--}}
            <br>
            <br>
            <br>
        @endif
        @break
        @case ('usuario')
        <a class="btn btn-dark form-control"
           href="{!! route('controle_usuarios.create') !!}">Novo Usuário</a>
        @break;

        @case ('projeto')
        <a class="btn btn-dark form-control"
           href="{!! route('controle_projetos_create',['organizacao_id' => $repositorio->codrepositorio]) !!}">Novo
            Projeto</a>
        @break;
        @case ('documentacao')
        <a class="btn btn-dark form-control"
           href="{!! route('controle_documentacoes.create')!!}">Nova
            Documentação</a>
        @break;
    @endswitch


@endif
