<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">

    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="{{ route('/') }}">RPN - Repositório de Processos de Negócio</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                @Auth
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="{{ route('painel') }}">Painel</a>
                    </li>
                @endauth

                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{ route('modelos_publicos') }}">Modelos</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{ route('/') }}">Início</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="{{ route('login') }}">{{ trans('auth.Login') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger"
                       href="{{ route('register') }}">{{ trans('auth.Register') }}</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
