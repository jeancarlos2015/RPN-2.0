 <nav class="navbar navbar-expand-sm navbar-default">
        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Controles</a>
                    <ul class="sub-menu children dropdown-menu">
                        {{--<li><i class="fa fa-puzzle-piece"></i><a href="{{route('controle_usuarios.index')}}">Controle De Usuários</a></li>--}}
                        <li><i class="fa fa-id-badge"></i><a href="#">Controle De Recursos</a></li>
                        <li><i class="fa fa-bars"></i><a href="#">Controle De Tarefas</a></li>
                        <li><i class="fa fa-share-square-o"></i><a href="#">Controle De Execução</a></li>
                        <li><i class="fa fa-share-square-o"></i><a href="{{route('area')}}">Área De Trabalho</a></li>
                        <li><i class="fa fa-share-square-o"></i><a href="https://demo.bpmn.io/new">Modelagem</a></li>
                    </ul>
                </li>
                <h3 class="menu-title">Controle De Versionamento</h3><!-- /.menu-title -->
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Versionamento</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-puzzle-piece"></i><a href="{{route('index_git_init')}}">Inicialização De Repositório</a></li>
                        <li><i class="fa fa-id-badge"></i><a href="{{route('index_create_branch')}}">Criação De Branch</a></li>
                        <li><i class="fa fa-bars"></i><a href="{{route('index_git_commit')}}">Commit Branch</a></li>
                        <li><i class="fa fa-share-square-o"></i><a href="{{route('index_merge_branch')}}">Merger Branch</a></li>
                        <li><i class="fa fa-share-square-o"></i><a href="{{route('index_checkout_branch')}}">Checkout Branch</a></li>
                        <li><i class="fa fa-share-square-o"></i><a href="{{route('index_clone_repository')}}">Clonar Repositório</a></li>
                    </ul>
                </li>
                <h3 class="menu-title">Extras</h3><!-- /.menu-title -->
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-dashboard"></i>Páginas</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-user"></i><a href="page-login.html">Autenticação</a></li>
                        <li><i class="menu-icon fa fa-sign-in"></i><a href="page-register.html">Registro</a></li>
                        <li><i class="menu-icon fa fa-paper-plane"></i><a href="pages-forget.html">Redefinição De Senha</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
