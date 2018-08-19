@if(Auth::user()->tipo === 'Administrador' || Auth::user()->email==='jeancarlospenas25@gmail.com')
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents2"
           data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-cogs"></i>
            <span class="nav-link-text">Configuração</span>
        </a>
        <ul class="sidenav-second-level collapse" id="collapseComponents2">
            <li>
                <a href="{!! route('controle_usuarios.index') !!}"><i class="fa fa-fw fa-pencil"></i>Controle de
                    Usuário</a>
            </li>
            <li>
                <a href="{!! route('vinculo_usuario_repositorio') !!}"><i class="fa fa-fw fa-pencil"></i>Vínculos
                    de Usuários</a>
            </li>
            <li>
                <a href="{!! route('create_github',['codusuario' => Auth::user()->codusuario]) !!}"><i
                            class="fa fa-fw fa-pencil"></i>Github</a>
            </li>
        </ul>
    </li>
@else
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents2"
           data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-cogs"></i>
            <span class="nav-link-text">Configuração</span>
        </a>
        <ul class="sidenav-second-level collapse" id="collapseComponents2">
            <li>
                <a href="{!! route('create_github',['codusuario' => Auth::user()->codusuario]) !!}"><i
                            class="fa fa-fw fa-pencil"></i>Github</a>
            </li>

        </ul>


    </li>
@endif