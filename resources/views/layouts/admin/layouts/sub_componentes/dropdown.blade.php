<div class="dropdown">
    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
        Opções
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="{!! route('painel') !!}">Painel</a>
        <a class="dropdown-item" href="{!! route('index_logs') !!}">Logs do Sistema</a>
        @if(!empty(Auth::user()->github->branch_atual) && !empty(Auth::user()->github->repositorio_atual))
            <a class="dropdown-item" href="{!! route('index_init') !!}">Bases</a>
        @endif
        <a class="dropdown-item" href="{!! route('controle_documentacoes.index') !!}">Documentação do
            Sistema</a>
    </div>
</div>