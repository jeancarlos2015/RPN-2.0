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