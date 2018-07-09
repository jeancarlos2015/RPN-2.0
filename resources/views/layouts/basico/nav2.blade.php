<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('/') }}">SISTEMA RPN</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">

                @guest
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('/') }}">Início
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li><a class="nav-link " href="{{ route('login') }}">{{ trans('auth.Login') }}</a></li>
                    <li><a class="nav-link" href="{{ route('register') }}">{{ trans('auth.Register') }}</a></li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link " href="{{ route('index') }}">Principal
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link" href="#" role="button">
                            {{ Auth::user()->name }} <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
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
                @endguest
            </ul>
        </div>
    </div>
</nav>