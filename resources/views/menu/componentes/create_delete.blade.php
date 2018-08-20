@if(Auth::user()->email==='jeancarlospenas25@gmail.com')
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="{!! $componente !!}"
           data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-cogs"></i>
            <span class="nav-link-text">{!! $titulo !!}</span>
        </a>
        <ul class="sidenav-second-level collapse" id="{!! $id !!}">
            <li>
                <form class="form-group" action="{!! route($rota) !!}" method="post">
                    @csrf
                    <div class="form-control">
                        <input type="text" name="branch" placeholder="Branch">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-secondary form-control"
                                title="{!! $descricao !!}">{!! $nome_botao !!}
                        </button>
                    </div>
                </form>
            </li>

        </ul>
    </li>
@endif