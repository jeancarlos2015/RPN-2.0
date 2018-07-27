<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">

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

    
    
    @if(Auth::user()->type === 'administrador' || Auth::user()->email==='jeancarlospenas25@gmail.com')
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
                    <a href="{!! route('edit_user',['id' => Auth::user()->codusuario]) !!}"><i
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
                <span class="nav-link-text">Commit & Push</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseComponents3">
                <li>
                    <form class="form-group" action="{!! route('commit') !!}" method="post">
                        @csrf
                        <div class="form-group">
                        <textarea type="text" name="commit" class="form-control"
                                  placeholder="Commit Message"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary form-control">Commit & Push</button>
                        </div>

                    </form>
                </li>

            </ul>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents4"
               data-parent="#exampleAccordion">
                <i class="fa fa-fw fa-cogs"></i>
                <span class="nav-link-text">Merge & Checkout</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseComponents4">
                <li>
                    <form class="form-group" action="{!! route('merge_checkout') !!}" method="post">
                        @csrf
                        <div class="form-group">

                            <select class="form-control" name="branch">
                                @if(!empty(Auth::user()->branchs))
                                    @foreach(Auth::user()->branchs as $branch)
                                        @if(Auth::user()->github->branch_atual !== $branch->branch)
                                            <option value="{!! $branch->branch !!}">{!! $branch->branch !!}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group text-light">
                            <input type="radio" name="tipo" value="merge"> Merge
                        </div>
                        <div class="form-group text-light">
                            <input type="radio" name="tipo" value="checkout" checked>Checkout
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary form-control">Executar</button>
                        </div>

                    </form>
                </li>

            </ul>
        </li>

        {{--<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">--}}
            {{--<a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents6"--}}
               {{--data-parent="#exampleAccordion">--}}
                {{--<i class="fa fa-fw fa-cogs"></i>--}}
                {{--<span class="nav-link-text">Pull</span>--}}
            {{--</a>--}}
            {{--<ul class="sidenav-second-level collapse" id="collapseComponents6">--}}
                {{--<li>--}}
                    {{--<form class="form-group" action="{!! route('pull') !!}" method="post">--}}
                        {{--@csrf--}}
                        {{--<div class="form-group">--}}
                            {{--<button type="submit" class="btn btn-secondary form-control">Pull</button>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</li>--}}

            {{--</ul>--}}
        {{--</li>--}}

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents7"
               data-parent="#exampleAccordion">
                <i class="fa fa-fw fa-cogs"></i>
                <span class="nav-link-text">Create Branch</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseComponents7">
                <li>
                    <form class="form-group" action="{!! route('create') !!}" method="post">
                        @csrf
                        <div class="form-control">
                            <input type="text" name="branch" placeholder="Branch">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary form-control">Create</button>
                        </div>
                    </form>
                </li>

            </ul>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents8"
               data-parent="#exampleAccordion">
                <i class="fa fa-fw fa-cogs"></i>
                <span class="nav-link-text">Delete Branch</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseComponents8">
                <li>
                    <form class="form-group" action="{!! route('delete') !!}" method="post">
                        @csrf
                        <div class="form-group">
                            <select class="form-control" name="branch">
                                @if(!empty(Auth::user()->branchs))
                                    @foreach(Auth::user()->branchs as $branch)
                                        @if(Auth::user()->github->branch_atual !== $branch->branch)
                                            <option value="{!! $branch->branch !!}">{!! $branch->branch !!}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary form-control">Delete Branch</button>
                        </div>
                    </form>
                </li>

            </ul>
        </li>
    @endif

    
</ul>
