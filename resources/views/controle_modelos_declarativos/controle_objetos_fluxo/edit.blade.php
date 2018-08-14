
@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                      'titulo' => 'Painel',
                    'sub_titulo' => 'Atualizar Objeto de Fluxo',
                    'rota' => 'controle_objetos_fluxos.index'
    ])
    <form action="{!! route('controle_objetos_fluxos.update',[$objeto_fluxo->codobjetofluxo]) !!}" method="post">
        @method('PUT')
        @includeIf('controle_modelos_declarativos.controle_objetos_fluxo.form',
        [
        'acao' => 'Atualizar  e Prosseguir',
        'dados' => $dados,
        'MAX' => 2,
        'objeto_fluxo' => $objeto_fluxo
        ]
        )
    </form>
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