<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">

    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents1">
            <i class="fa fa-fw fa-list"></i>
            <span class="nav-link-text">Sistema</span>
        </a>
        <ul class="sidenav-second-level collapse" id="collapseComponents1">
            <li>
                <a href="{!! route('painel') !!}"><i class="fa fa-fw fa-pencil"></i>Painel</a>
            </li>

            <li>
                <a href="{!! route('todos_modelos') !!}"><i class="fa fa-fw fa-pencil"></i>Modelos</a>
            </li>

            <li>
                <a href="{!! route('controle_organizacoes.index') !!}"><i class="fa fa-fw fa-pencil"></i>Organizações</a>
            </li>

            <li>
                <a href="{!! route('todas_tarefas') !!}"><i class="fa fa-fw fa-pencil"></i>Tarefas</a>
            </li>

            <li>
                <a href="{!! route('todos_projetos') !!}"><i class="fa fa-fw fa-pencil"></i>Projetos</a>
            </li>
            <li>
                <a href="{!! route('todas_regras') !!}"><i class="fa fa-fw fa-pencil"></i>Regras</a>
            </li>

        </ul>
    </li>



    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents"
           data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-building"></i>
            <span class="nav-link-text">Versionamento</span>
        </a>
        <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
                <a href="{!! route('index_painel') !!}"><i class="fa fa-fw fa-pencil"></i>Painel</a>
            </li>

            <li>
                <a href="{!! route('index_merge_checkout') !!}"><i class="fa fa-fw fa-pencil"></i>Merge &
                    Checkout</a>
            </li>

            <li>
                <a href="{!! route('index_create_delete') !!}"><i class="fa fa-fw fa-pencil"></i>Create &
                    Delete</a>
            </li>

            <li>
                <a href="{!! route('index_commit_branch') !!}"><i class="fa fa-fw fa-pencil"></i>Commit
                    Branch</a>
            </li>

            <li>
                <a href="{!! route('index_pull_push') !!}"><i class="fa fa-fw fa-pencil"></i>Pull &
                    Push Repository</a>
            </li>
            <li>
                <a href="{!! route('index_init') !!}"><i class="fa fa-fw fa-pencil"></i>Initialization
                    Repository</a>
            </li>
        </ul>
    </li>

</ul>