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
                <a href="{!! route('controle_organizacoes.index') !!}"><i
                            class="fa fa-fw fa-pencil"></i>Organizações</a>
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
                    Push </a>
            </li>
            <li>
                <a href="{!! route('index_init') !!}"><i class="fa fa-fw fa-pencil"></i>Criação de Repositório</a>
            </li>

        </ul>
    </li>
    @if(Auth::user()->type === 'administrador')
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents2"
               data-parent="#exampleAccordion">
                <i class="fa fa-fw fa-cogs"></i>
                <span class="nav-link-text">Configuração</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseComponents2">
                <li>
                    <a href="{!! route('controle_usuarios.index') !!}"><i class="fa fa-fw fa-pencil"></i>Controle de
                        Usuário</a>
                </li>
                <li>
                    <a href="{!! route('create_github',['codusuario' => Auth::user()->codusuario]) !!}"><i
                                class="fa fa-fw fa-pencil"></i>Github</a>
                </li>
            </ul>
        </li>
    @else
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents2"
               data-parent="#exampleAccordion">
                <i class="fa fa-fw fa-cogs"></i>
                <span class="nav-link-text">Configuração</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseComponents2">
                <li>
                    <a href="{!! route('controle_usuarios.edit',['id' => Auth::user()->codusuario]) !!}"><i
                                class="fa fa-fw fa-pencil"></i>Atualizar Conta</a>


                </li>
                <li>
                    <a href="{!! route('create_github',['codusuario' => Auth::user()->codusuario]) !!}"><i
                                class="fa fa-fw fa-pencil"></i>Github</a>
                </li>


            </ul>


        </li>
    @endif

    @if(!empty(Auth::user()->github->branch_atual) && !empty(Auth::user()->github->repositorio_atual))
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents3"
               data-parent="#exampleAccordion">
                <i class="fa fa-fw fa-cogs"></i>
                <span class="nav-link-text">Commit</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseComponents3">
                <li>
                    <form class="form-group">
                        @csrf
                        <div class="form-group">
                            <textarea type="text" name="commit" class="form-control" placeholder="Commit Message"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary">Commit</button>
                        </div>

                    </form>
                </li>

            </ul>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents4"
               data-parent="#exampleAccordion">
                <i class="fa fa-fw fa-cogs"></i>
                <span class="nav-link-text">Checkout</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseComponents4">
                <li>
                    <form class="form-group">
                        @csrf
                        <div class="form-group">
                            <select name="branch" class="form-control">
                                <option>branch 1</option>
                                <option>branch 2</option>
                                <option>branch 3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary">Checkout</button>
                        </div>

                    </form>
                </li>

            </ul>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents5"
               data-parent="#exampleAccordion">
                <i class="fa fa-fw fa-cogs"></i>
                <span class="nav-link-text">Merge</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseComponents5">
                <li>
                    <form class="form-group">
                        @csrf
                        <div class="form-group">
                            <select name="branch" class="form-control">
                                <option>branch 1</option>
                                <option>branch 2</option>
                                <option>branch 3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary">Merge</button>
                        </div>

                    </form>
                </li>

            </ul>
        </li>
    @endif
</ul>
