@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                      'titulo' => 'Painel',
                    'sub_titulo' => 'Repositório / '.$modelo_declarativo->repositorio->nome.
                                    '/ Projeto / '.$modelo_declarativo->projeto->nome.
                                    '/ Mode Declarativo / '.$modelo_declarativo->nome.
                                    '/ Novo Objeto de Fluxo / ',
                    'rota' => 'controle_objetos_fluxos.index'
    ])
    <form action="{!! route('controle_objetos_fluxos.store') !!}" method="post">
        @includeIf('controle_modelos_declarativos.controle_objetos_fluxo.form',
        [
        'acao' => 'Criar Objeto de Fluxo',
        'dados' => $dados,
        'MAX' => 2
        ])
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

