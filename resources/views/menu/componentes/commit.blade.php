<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents3"
       data-parent="#exampleAccordion">
        <i class="fa fa-fw fa-cogs"></i>
        <span class="nav-link-text">Salvar Alterações</span>
    </a>
    <ul class="sidenav-second-level collapse" id="collapseComponents3" >
        <li>
            <form class="form-group" action="{!! route('commit') !!}" method="post">
                @csrf
                <div class="form-group">
                        <textarea type="text" name="commit" class="form-control"
                                  placeholder="Commit Message"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-secondary form-control" title="Este método faz o commit( Confiirma as alterações) na branch/Ramo ao qual a base de dados está relacionada">Salvar Alterações</button>
                </div>

            </form>
        </li>

    </ul>
</li>