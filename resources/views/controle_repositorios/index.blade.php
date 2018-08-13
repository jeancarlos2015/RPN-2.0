@extends('layouts.layout_admin_new.layouts.main')

@section('content')

        @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                        'titulo' => 'Painel',
                        'sub_titulo' => 'Repositórios',
                        'rota' => 'painel'
        ])



        @includeIf('layouts.layout_admin_new.componentes.botao',['tipo' => $tipo])


        @includeIf('layouts.layout_admin_new.componentes.tables',[
                        'titulos' => $titulos,
                        'repositorios' => $repositorios,
                        'rota_edicao' => 'controle_repositorios.edit',
                        'rota_exclusao' => 'controle_repositorios.destroy',
                        'rota_cricao' => 'controle_repositorios.create',
                        'rota_exibicao' => 'controle_repositorios.show',
                        'nome_botao' => 'Novo',
                        'titulo' =>'Repositórios',
                        'tipo' => $tipo

        ])

@endsection

@section('modo')
    <li class="nav-item">
        <a class="nav-link" title="Modo de Edição de Objeto de Fluxo">
            <p class="fa fa-dashboard"> Repositórios</p>
            <span class="sr-only"></span>
        </a>
    </li>
@endsection