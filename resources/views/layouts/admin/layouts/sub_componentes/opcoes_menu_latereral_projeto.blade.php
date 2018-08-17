<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents1">
        <i class="fa fa-fw fa-list"></i>
        <span class="nav-link-text">Sistema</span>
    </a>


    <ul class="sidenav-second-level collapse" id="collapseComponents1">

        <li>
            <a href="{!! route('painel') !!}"><i class="fa fa-fw fa-pencil"></i>Todos</a>
        </li>
        <li>
            <a href="{!! route('todos_modelos') !!}"><i class="fa fa-fw fa-pencil"></i>Modelos</a>
        </li>
        
        <li>
            <a href="{!! route('controle_regras.index') !!}"><i class="fa fa-fw fa-pencil"></i>Regras</a>
        </li>
        <li>
            <a href="{!! route('controle_objetos_fluxos.index') !!}"><i class="fa fa-fw fa-pencil"></i>Objetos De Fluxo</a>
        </li>
        @if(Auth::user()->email==='jeancarlospenas25@gmail.com')
            <li>
                <a href="{!! route('controle_repositorios.index') !!}"><i
                            class="fa fa-fw fa-pencil"></i>Repositórios</a>
            </li>
        @endif

        <li>
            <a href="{!! route('todos_projetos') !!}"><i class="fa fa-fw fa-pencil"></i>Projetos</a>
        </li>



    </ul>
</li>