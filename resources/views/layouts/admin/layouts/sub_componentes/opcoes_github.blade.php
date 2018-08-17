@if(!empty(Auth::user()->github->branch_atual) && !empty(Auth::user()->github->repositorio_atual))
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents3"
           data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-cogs"></i>
            <span class="nav-link-text">Salvar Alterações</span>
        </a>
        <ul class="sidenav-second-level collapse" id="collapseComponents3">
            <li>
                <form class="form-group" action="{!! route('commit') !!}" method="post">
                    @csrf
                    <div class="form-group">
                        <textarea type="text" name="commit" class="form-control"
                                  placeholder="Commit Message"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-secondary form-control">Salvar Alterações</button>
                    </div>

                </form>
            </li>

        </ul>
    </li>
    @if(Auth::user()->email==='jeancarlospenas25@gmail.com')
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents10"
               data-parent="#exampleAccordion">
                <i class="fa fa-fw fa-cogs"></i>
                <span class="nav-link-text">Juntar Ramificação</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseComponents10">
                <li>
                    <form class="form-group" action="{!! route('merge_checkout') !!}" method="post">
                        @csrf
                        <div class="form-group">

                            @if(!empty(Auth::user()->branchs))
                                @foreach(Auth::user()->branchs as $branch)
                                    @if(Auth::user()->github->branch_atual !== $branch->branch)

                                        <div class="form-check btn-dark">
                                            <input type="radio" class="form-check-input"
                                                   id="materialUnchecked{{$branch->codbranch}}" name="branch"
                                                   value="{{$branch->branch}}">
                                            <label class="form-check-label"
                                                   for="materialUnchecked">{{$branch->branch}}</label>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                        <div class="form-group text-light">
                            <input type="hidden" name="tipo" value="merge">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary form-control">Executar</button>
                        </div>

                    </form>
                </li>

            </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents11"
               data-parent="#exampleAccordion">
                <i class="fa fa-fw fa-cogs"></i>
                <span class="nav-link-text">Trocar Ramificação</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseComponents11">
                <li>
                    <form class="form-group" action="{!! route('merge_checkout') !!}" method="post">
                        @csrf
                        <div class="form-group">

                            @if(!empty(Auth::user()->branchs))
                                @foreach(Auth::user()->branchs as $branch)
                                    @if(Auth::user()->github->branch_atual !== $branch->branch)
                                        <div class="form-check btn-dark">
                                            <input type="radio" class="form-check-input"
                                                   id="materialUnchecked{{$branch->codbranch}}" name="branch"
                                                   value="{{$branch->branch}}">
                                            <label class="form-check-label"
                                                   for="materialUnchecked">{{$branch->branch}}</label>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                        <div class="form-group text-light">
                            <input type="hidden" name="tipo" value="checkout">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary form-control">Executar</button>
                        </div>

                    </form>
                </li>

            </ul>
        </li>
    @else
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents11"
               data-parent="#exampleAccordion">
                <i class="fa fa-fw fa-cogs"></i>
                <span class="nav-link-text">Trocar Ramificação</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseComponents11">
                <li>
                    <form class="form-group" action="{!! route('merge_checkout') !!}" method="post">
                        @csrf
                        <div class="form-group">

                            @if(!empty(Auth::user()->branchs))
                                @foreach(Auth::user()->branchs as $branch)
                                    @if(Auth::user()->github->branch_atual !== $branch->branch)
                                        @if($branch->branch!=='master')
                                            <div class="form-check btn-dark">
                                                <input type="radio" class="form-check-input"
                                                       id="materialUnchecked{{$branch->codbranch}}"
                                                       name="branch"
                                                       value="{{$branch->branch}}">
                                                <label class="form-check-label"
                                                       for="materialUnchecked">{{$branch->branch}}</label>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                        </div>
                        <div class="form-group text-light">
                            <input type="hidden" name="tipo" value="checkout">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary form-control">Executar</button>
                        </div>

                    </form>
                </li>

            </ul>
        </li>
    @endif


    @if(Auth::user()->email==='jeancarlospenas25@gmail.com')
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents7"
               data-parent="#exampleAccordion">
                <i class="fa fa-fw fa-cogs"></i>
                <span class="nav-link-text">Criar Ramificação</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseComponents7">
                <li>
                    <form class="form-group" action="{!! route('create') !!}" method="post">
                        @csrf
                        <div class="form-control">
                            <input type="text" name="branch" placeholder="Branch">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary form-control">Criar</button>
                        </div>
                    </form>
                </li>

            </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents8"
               data-parent="#exampleAccordion">
                <i class="fa fa-fw fa-cogs"></i>

                <label for="sel1"><span class="nav-link-text">Excluir Ramificação</span></label>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseComponents8">
                <li>
                    <form class="form-group" action="{!! route('delete') !!}" method="post">
                        @csrf
                        @method('POST')

                        <div class="form-group">
                            @if(!empty(Auth::user()->branchs))
                                @foreach(Auth::user()->branchs as $branch)
                                    @if(Auth::user()->github->branch_atual !== $branch->branch)


                                        <div class="form-check btn-dark">
                                            <input type="radio" class="form-check-input"
                                                   id="materialUnchecked{{$branch->codbranch}}" name="branch"
                                                   value="{{$branch->branch}}">
                                            <label class="form-check-label"
                                                   for="materialUnchecked">{{$branch->branch}}</label>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary form-control">Excluir Ramificação
                            </button>
                        </div>
                    </form>
                </li>

            </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents8"
               data-parent="#exampleAccordion">
                <i class="fa fa-fw fa-cogs"></i>

                <label for="sel1"><span class="nav-link-text">Excluir Ramificação</span></label>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseComponents8">
                <li>
                    <form class="form-group" action="{!! route('delete') !!}" method="post">
                        @csrf
                        @method('POST')

                        <div class="form-group">
                            @if(!empty(Auth::user()->branchs))
                                @foreach(Auth::user()->branchs as $branch)
                                    @if(Auth::user()->github->branch_atual !== $branch->branch)

                                        <div class="form-check btn-dark">
                                            <input type="radio" class="form-check-input"
                                                   id="materialUnchecked{{$branch->codbranch}}" name="branch"
                                                   value="{{$branch->branch}}">
                                            <label class="form-check-label"
                                                   for="materialUnchecked">{{$branch->branch}}</label>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary form-control">Excluir Ramificação
                            </button>
                        </div>
                    </form>
                </li>

            </ul>
        </li>
    @endif



@endif