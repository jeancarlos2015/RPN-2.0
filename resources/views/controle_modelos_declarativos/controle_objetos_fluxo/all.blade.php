@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                      'titulo' => 'Painel',
                    'sub_titulo' => 'Objetos De Fluxo',
                    'rota' => 'painel'
    ])
    @includeIf('layouts.layout_admin_new.componentes.tables',[
                    'titulos' => $titulos,
                    'regras' => $objetos_fluxos,
                    'rota_edicao' => 'controle_regras.edit',
                    'rota_exclusao' => 'controle_regras.destroy',
                    'rota_exibicao' => 'controle_objetos_fluxos.show',
                    'nome_botao' => 'Novo',
                    'titulo' =>'Regras'
    ])
@endsection

@section('modo')
    <li class="nav-item">
        <a class="nav-link" title="Modo de Edição de Objeto de Fluxo">
            <p class="fa fa-dashboard"> Controle de Objetos de fluxo</p>
            <span class="sr-only"></span>
        </a>
    </li>
@endsection