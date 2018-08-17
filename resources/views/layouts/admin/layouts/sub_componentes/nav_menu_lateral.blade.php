<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
    @if(!empty(Auth::user()->repositorio) || Auth::user()->email==='jeancarlospenas25@gmail.com')
        @includeIf('layouts.admin.layouts.sub_componentes.opcoes_menu_latereral_projeto')
        @includeIf('layouts.admin.layouts.sub_componentes.opcoes_administrador')
        @includeIf('layouts.admin.layouts.sub_componentes.opcoes_github')
    @endif
</ul>
