
@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                      'titulo' => 'Painel',
                    'sub_titulo' => 'Objetos De Fluxo',
                    'rota' => 'painel'
    ])
    @if(!empty($modelo_declarativo))
    @includeIf('layouts.layout_admin_new.componentes.botao',['tipo' => $tipo])
    @endif
    @includeIf('layouts.layout_admin_new.componentes.tables',[
                    'titulos' => $titulos,
                    'regras' => $objetos_fluxos,
                    'rota_edicao' => 'controle_objetos_fluxos.edit',
                    'rota_exclusao' => 'controle_objetos_fluxos.destroy',
                    'rota_exibicao' => 'controle_objetos_fluxos.show',
                    'nome_botao' => 'Novo',
                    'titulo' =>'Objetos de Fluxo'
    ])
    <div class="form-group">
        <a href="{!! route('controle_padrao_create_conjunto',[$modelo_declarativo->codmodelodeclarativo]) !!}"
           class="btn btn-dark form-control">
            >>Seguir para Página de Aplique de Padrões de Recomendação Entre Conjuntos
        </a>


    </div>

    <div class="form-group">
        <a href="{!! route('controle_padrao_create_binario',[$modelo_declarativo->codmodelodeclarativo]) !!}"
           class="btn btn-dark form-control">
            >>Seguir para Página de Aplique de Padrões de Recomendação Entre Objetos
        </a>
    </div>

@endsection

@section('modo')
    @includeIf('componentes.descricao',[
        'descricao_titulo_menu' => 'Modo de Edição de Objeto de Fluxo',
        'nome_titulo_menu' => 'Controle de Objetos de fluxo'
    ])
@endsection