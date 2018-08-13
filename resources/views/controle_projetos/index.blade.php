@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @if(!empty($repositorio))
        @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                          'titulo' => 'Painel',

                        'sub_titulo' => 'Repositório / '.$repositorio->nome.' / Projetos',
                        'rota' => 'painel'
        ])


        @includeIf('layouts.layout_admin_new.componentes.botao',['tipo' => $tipo])


@else
        @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                          'titulo' => 'Painel',

                        'sub_titulo' => 'Painel/Todos Projetos',
                        'rota' => 'painel'
        ])
    @endif

    @includeIf('layouts.layout_admin_new.componentes.tables',[
                    'titulos' => $titulos,
                    'projetos' => $projetos,
                    'rota_edicao' => 'controle_projetos.edit',
                    'rota_exclusao' => 'controle_projetos.destroy',
                    'rota_cricao' => 'controle_projetos.create',
                    'rota_exibicao' => 'controle_projetos.show',
                    'nome_botao' => 'Novo',
                    'botao' => 'Novo',
                    'titulo' => 'Projetos'
    ])
@endsection

@section('modo')
    <li class="nav-item">
        <a class="nav-link" title="Modo de Edição de Objeto de Fluxo">
            <p class="fa fa-dashboard"> Todos os Projetos</p>
            <span class="sr-only"></span>
        </a>
    </li>
@endsection