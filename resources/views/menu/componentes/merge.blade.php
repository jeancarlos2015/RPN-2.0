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
                <div class="form-group">

                    @if(!empty(Auth::user()->branchs))
                        @foreach(Auth::user()->branchs as $branch)
                            @if(Auth::user()->github->branch_atual !== $branch->branch)
                                @if(Auth::user()->email==='jeancarlospenas25@gmail.com')
                                    <div class="form-check btn-dark">
                                        <input type="radio" class="form-check-input"
                                               id="materialUnchecked{{$branch->cod_branch}}" name="branch"
                                               value="{{$branch->branch}}">
                                        <label class="form-check-label"
                                               for="materialUnchecked">{{$branch->branch}}</label>
                                    </div>
                                @else
                                    @if($branch->branch!=='master')
                                        <div class="form-check btn-dark">
                                            <input type="radio" class="form-check-input"
                                                   id="materialUnchecked{{$branch->cod_branch}}"
                                                   name="branch"
                                                   value="{{$branch->branch}}">
                                            <label class="form-check-label"
                                                   for="materialUnchecked">{{$branch->branch}}</label>
                                        </div>
                                    @endif
                                @endif

                            @endif
                        @endforeach
                    @endif
                </div>
                <div class="form-group text-light">
                    <input type="hidden" name="tipo" value="{!! $tipo !!}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-secondary form-control"
                            title="{!! $descricao !!}">
                        {!! $nome_botao !!}
                    </button>
                </div>

            </form>
        </li>

    </ul>
</li>