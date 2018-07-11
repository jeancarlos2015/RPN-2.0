@if(!empty($tipo))
    @switch($tipo)
        @case ('organizacao')
        <a class="btn btn-warning form-control"
           href="{!! route('controle_organizacoes.create') !!}">Nova Organização</a>
        @break;

        @case ('modelo')
        <a class="btn btn-dark form-control"
           href="">Novo Modelo</a>
        @break;

        @case ('regra')
        <a class="btn btn-primary form-control"
           href="">Nova Regra</a>
        @break;

        @case ('tarefa')
        <a class="btn btn-primary form-control"
           href="">Nova Tarefa</a>
        @break;

        @case ('projeto')
        <a class="btn btn-dark form-control"
           href="">Novo Projeto</a>
        @break;

    @endswitch


@endif