<ul class="navbar-nav ml-auto">

    <li class="nav-item">
        <a class="nav-link" href="https://docs.google.com/document/d/1wGnEyeuDx6bYlJMeshtWxvQ-lW6dGVK1wLyWWLjmN7o/edit?usp=sharing">
            <p class="fa fa-lightbulb-o"> Sugestões e Idéias </p>
            <span class="sr-only"></span>
        </a>
    </li>
    @yield('modo')

    @if(!empty(Auth::user()->email==='jeancarlospenas25@gmail.com'))
        <li class="nav-item">
            <a class="nav-link">
                <p class="fa fa-user"> Administrador do Sistema </p>
                <span class="sr-only"></span>
            </a>
        </li>
    @endif

    @if(!empty(Auth::user()->repositorio))
        <li class="nav-item">
            <a class="nav-link">
                <p class="fa fa-database"> Repositório: {{ Auth::user()->repositorio->nome }} </p>
                <span class="sr-only"></span>
            </a>
        </li>
    @endif


    @if(!empty(Auth::user()->repositorio) || Auth::user()->email==='jeancarlospenas25@gmail.com')

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
        @if(!empty(Auth::user()->github->branch_atual) && !empty(Auth::user()->github->repositorio_atual))
            <li class="nav-item">
                <a class="btn btn-dark" href="{!! route('pull') !!}">Atualizar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link">

                    {{--Usuário Github: {{ Auth::user()->usuario_github() }} <span class="sr-only"></span>--}}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link">
                    Ramificação : {{ Auth::user()->github->branch_atual }} <span class="sr-only"></span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link">
                    Base: {{ Auth::user()->github->repositorio_atual }} <span class="sr-only"></span>
                </a>
            </li>
        @endif


        <li class="nav-item dropdown">

            <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-fw fa-bell"></i>
                <span class="d-lg-none">Alerta

            </span>
                <span class="indicator text-warning d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
                <div class="dropdown-menu" aria-labelledby="alertsDropdown">
                    @if(!empty($log))

                        @includeIf('layouts.admin.componentes.alert',
                            [
                            'log' => $log
                            ])

                    @endif
                </div>

            </a>

        </li>
    @endif
    <li class="nav-item">
        <div class="dropdown">
            <button class="btn btn-link" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                <div class="media">
                    <img class="d-flex mr-3 rounded-circle" src="{{ Gravatar::src(Auth::user()->email) }}" alt=""
                         width="30">
                    <div class="media-body">
                        <strong>{{ Auth::user()->name }}</strong>
                        {{--<div class="text-muted smaller">Today at 5:43 PM - 5m ago</div>--}}
                    </div>
                </div>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    {{ trans('auth.Logout') }}
                    <span class="sr-only">(current)</span>
                </a>

            </div>
        </div>

    </li>


    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</ul>
