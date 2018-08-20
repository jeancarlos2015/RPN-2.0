<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
    @if(!empty(Auth::user()->repositorio) || (Auth::user()->email==='jeancarlospenas25@gmail.com'|| Auth::user()->tipo==='Administrador'))
        @includeIf('layouts.admin.layouts.sub_componentes.opcoes_menu_latereral_projeto')
        @includeIf('menu.componentes.configuracao')
        @includeIf('layouts.admin.layouts.sub_componentes.opcoes_github')
    @endif
</ul>
