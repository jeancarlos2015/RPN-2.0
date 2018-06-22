 <div class="header-menu ">
            <div class="col-sm-7">
                <div class="header-left">
                    <button class="search-trigger"><i class="fa fa-search"></i></button>
                    <div class="form-inline">
                        <form class="search-form">
                            <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                            <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                        </form>
                    </div>

                    <div class="dropdown for-notification">
                        @if(isset($change) and $change=='true')
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell"></i>
                            <span class="count bg-danger">1</span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="notification">

                            <p class="red">Existem alterações No Projeto</p>
                            <a class="dropdown-item media bg-flat-color-1" href="#">
                                <i class="fa fa-check"></i>
                                <p>O modelo foi alterado na branch <strong>{!! $branch !!}</strong> </p>
                            </a>

                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="user-area dropdown float-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       {{\Illuminate\Support\Facades\Auth::user()->name}}
                    </a>

                    <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="#"><i class="fa fa- user"></i>Meu Perfil</a>

                        <a class="nav-link" href="#"><i class="fa fa- user"></i>Notificações <span class="count">13</span></a>

                        <a class="nav-link" href="#"><i class="fa fa -cog"></i>Configuração</a>
                        {{--<a class="nav-link" href="{{ route('logout') }}"--}}
                           {{--onclick="event.preventDefault();--}}
                                                     {{--document.getElementById('logout-form').submit();">--}}
                            {{--{{ trans('auth.Logout') }}--}}
                        {{--</a>--}}
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            {{ trans('auth.Logout') }}
                            {{--<span class="sr-only">(current)</span>--}}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>