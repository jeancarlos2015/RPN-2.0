<ul class="navbar-nav ml-auto">
    <div class="dropdown">
        <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
            Opções
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="{!! route('painel') !!}">Painel</a>
            <a class="dropdown-item" href="{!! route('index_logs') !!}">Logs do Sistema</a>
            @if(!empty(Auth::user()->github->branch_atual) && !empty(Auth::user()->github->repositorio_atual))
                
                <a class="dropdown-item" href="{!! route('index_init') !!}">Repositórios</a>
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
                Usuário Github: {{ Auth::user()->usuario_github() }} <span class="sr-only"></span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link">
                Branch Atual: {{ Auth::user()->github->branch_atual }} <span class="sr-only"></span>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link">
                Repositório Atual: {{ Auth::user()->github->repositorio_atual }} <span class="sr-only"></span>
            </a>
        </li>
    @endif
    {{--<li class="nav-item">--}}
    {{--<a class="nav-link" href="{!! route('controle_documentacoes.index') !!}">--}}
    {{--Documentação do Sistema <span class="sr-only"></span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--@if(!empty(Auth::user()->github->branch_atual) && !empty(Auth::user()->github->repositorio_atual))--}}
    {{--<li class="nav-item">--}}
    {{--<form action="{!! route('pull') !!}" method="post">--}}
    {{--@csrf--}}
    {{--<button type="submit" class="btn btn-dark">Atualizar</button>--}}
    {{--</form>--}}
    {{--</li>--}}

    {{--<li class="nav-item">--}}
    {{--<a class="nav-link" href="{!! route('index_init') !!}">--}}
    {{--Repositórios <span class="sr-only"></span>--}}
    {{--</a>--}}
    {{--</li>--}}
    {{--@endif--}}

    {{--<li class="nav-item">--}}
    {{--<a class="nav-link" href="{!! route('index_logs') !!}">--}}
    {{--Logs do Sistema <span class="sr-only"></span>--}}
    {{--</a>--}}
    {{--</li>--}}

    <li class="nav-item">
        <a class="nav-link">
            Usuário: {{ Auth::user()->name }} <span class="sr-only"></span>
        </a>
    </li>

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

                    @includeIf('layouts.layout_admin_new.componentes.alert',
                        [
                        'log' => $log
                        ])

                @endif
            </div>

        </a>

    </li>


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
