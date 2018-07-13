<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.blade.php">RPN - Repositório de Processos Negócio</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="{!! route('painel') !!}">
                    <i class="fa fa-fw fa-list"></i>
                    <span class="nav-link-text">Painel</span>
                </a>
            </li>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents"
                   data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-building"></i>
                    <span class="nav-link-text">Versionamento</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseComponents">

                    <li>
                        <a href="{!! route('controle_versao_projetos') !!}"><i class="fa fa-fw fa-pencil"></i>Merge &
                            Checkout</a>
                    </li>

                    <li>
                        <a href="{!! route('controle_versao_projetos') !!}"><i class="fa fa-fw fa-pencil"></i>Create &
                            Delete</a>
                    </li>

                    <li>
                        <a href="{!! route('controle_versao_projetos') !!}"><i class="fa fa-fw fa-pencil"></i>Commit
                            Branch</a>
                    </li>

                    <li>
                        <a href="{!! route('controle_versao_projetos') !!}"><i class="fa fa-fw fa-pencil"></i>Pull &
                            Push Repository</a>
                    </li>
                    <li>
                        <a href="{!! route('index_init') !!}"><i class="fa fa-fw fa-pencil"></i>Initialization
                            Repository</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages"
                   data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-file"></i>
                    <span class="nav-link-text">Usuários</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseExamplePages">
                    <li>
                        <a href="#">Não Informado</a>
                    </li>
                </ul>
            </li>

        </ul>
        <ul class="navbar-nav ml-auto">


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fw fa-bell"></i>
                    <span class="d-lg-none">Alerta

              <span class="badge badge-pill badge-warning">
                  @if(!empty($quantidade_logs))
                      @if($quantidade_logs)
                          {!! $quantidade_logs !!} Novas
                      @endif
                  @endif
              </span>
            </span>
                    <span class="indicator text-warning d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
                    <div class="dropdown-menu" aria-labelledby="alertsDropdown">
                        @if(!empty($logs))
                            @foreach($logs as $log)
                                @includeIf('layouts.layout_admin_new.componentes.alert',
                                    [
                                    'log' => $log
                                    ])
                            @endforeach
                        @endif
                    </div>

                </a>

            </li>

            <li class="nav-item">
                <a class="nav-link">
                    Usuário: {{ Auth::user()->name }} <span class="sr-only"></span>
                </a>
            </li>


            {{--<li class="nav-item">--}}
            {{--<form class="form-inline my-2 my-lg-0 mr-lg-2">--}}
            {{--<div class="input-group">--}}
            {{--<input class="form-control" type="text" placeholder="Pesquisar...">--}}
            {{--<span class="input-group-append">--}}
            {{--<button class="btn btn-primary" type="button">--}}
            {{--<i class="fa fa-search"></i>--}}
            {{--</button>--}}
            {{--</span>--}}
            {{--</div>--}}
            {{--</form>--}}
            {{--</li>--}}

            <li class="nav-item">

                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    {{ trans('auth.Logout') }}
                    <span class="sr-only">(current)</span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</nav>