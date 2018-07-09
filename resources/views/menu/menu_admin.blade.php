<nav class="navbar navbar-expand-sm navbar-fixed-left">
    <div class="navbar-header">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu"
                aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
        </button>

    </div>
    <div id="main-menu" class="main-menu collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <li>
                <a href="index.html"> <i class="menu-icon fa fa-dashboard"></i>Menu Administrador </a>
            </li>
            <h3 class="menu-title">Controles</h3><!-- /.menu-title -->
            <li class="menu-item-has-children dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="menu-icon fa fa-laptop"></i>Controles</a>
                <ul class="sub-menu children dropdown-menu">
                    <li><i class="fa fa-puzzle-piece"></i><a href="{!! route('controle_organizacoes.index') !!}">
                            Controle De Organizações</a></li>
                    {{--<li><i class="fa fa-puzzle-piece"></i><a href="{!! route('controle_organizacoes.index') !!}">--}}
                            {{--Todos os Projetos</a></li>--}}
                    <li><i class="fa fa-puzzle-piece"></i><a href="{!! route('todos_modelos') !!}">
                            Todos os Modelos</a></li>
                    {{--<li><i class="fa fa-puzzle-piece"></i><a href="{!! route('controle_organizacoes.index') !!}">--}}
                            {{--Todas as Tarefas</a></li>--}}
                    {{--<li><i class="fa fa-puzzle-piece"></i><a href="{!! route('controle_organizacoes.index') !!}">--}}
                            {{--Todas as Regras</a></li>--}}
                    {{--<li><i class="fa fa-puzzle-piece"></i><a href="#">Controle De Versionamento</a></li>--}}

                </ul>

            </li>

            <h3 class="menu-title">Configurações</h3><!-- /.menu-title -->
            <li class="menu-item-has-children dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="menu-icon fa fa-dashboard"></i>Permissões</a>
                <ul class="sub-menu children dropdown-menu">
                    <li><i class="menu-icon fa fa-user"></i><a href="page-login.html">Autenticação</a></li>
                    <li><i class="menu-icon fa fa-sign-in"></i><a href="page-register.html">Registro</a></li>
                    <li><i class="menu-icon fa fa-paper-plane"></i><a href="{!! route('password.reset',['token' => csrf_token()]) !!}">Redefinição De Senha</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div><!-- /.navbar-collapse -->
</nav>
