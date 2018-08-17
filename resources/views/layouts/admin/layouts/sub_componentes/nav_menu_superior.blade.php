<ul class="navbar-nav ml-auto">

    @if(!empty(Auth::user()->repositorio) || Auth::user()->email==='jeancarlospenas25@gmail.com')

        @includeIf('layouts.admin.layouts.sub_componentes.li_nav',
            [
                'link' => 'https://docs.google.com/document/d/1wGnEyeuDx6bYlJMeshtWxvQ-lW6dGVK1wLyWWLjmN7o/edit?usp=sharing',
                'nome' => 'Sugestões e Idéias',
                'ico' => 'fa fa-lightbulb-o'
            ])

        @includeIf('layouts.admin.layouts.sub_componentes.li_nav',
           [
               'nome' => 'Repositório:' .Auth::user()->repositorio->nome,
               'ico' => 'fa fa-database'
           ])
    @endif

    @yield('modo')

    @if(Auth::user()->email==='jeancarlospenas25@gmail.com')
        @includeIf('layouts.admin.layouts.sub_componentes.li_nav',
            [
                'nome' => 'Administrador do Sistema',
                'ico' => 'fa fa-user'
            ])
    @endif


    @if(!empty(Auth::user()->repositorio) || Auth::user()->email==='jeancarlospenas25@gmail.com')
        @includeIf('layouts.admin.layouts.sub_componentes.dropdown')
        @includeIf('layouts.admin.layouts.sub_componentes.status_github')
        @includeIf('layouts.admin.layouts.sub_componentes.dropdown_alerta')
    @endif

    @includeIf('layouts.admin.layouts.sub_componentes.dropdown_usuario')
</ul>
