@extends('layouts.layout_admin_new.layouts.main')

@section('content')

    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                      'titulo' => 'Painel',
                    'sub_titulo' => 'Repositório / '.$modelo_declarativo->repositorio->nome.
                                    '/ Projeto / '.$modelo_declarativo->projeto->nome.
                                    '/ Mode Declarativo / '.$modelo_declarativo->nome.
                                    '/ Novo Objeto de Fluxo / ',
                    'rota' => 'controle_objetos_fluxos.index'
    ])
    <form action="{!! route('controle_padroes_recomendacao.store') !!}" method="post">
        @method('POST')
        @csrf
        @if($tipo_operacao==='conjunto')
            @includeIf('controle_modelos_declarativos.controle_regras.form_para_conjunto')
        @elseif($tipo_operacao==='binario')
            @includeIf('controle_modelos_declarativos.controle_regras.form_para_binario')
        @endif
    </form>

@endsection



@section('modo')
    @includeIf('componentes.descricao',[
        'descricao_titulo_menu' => 'Nesta página você vai aplicar os padrões de recomendação no modelo de clarativo',
        'nome_titulo_menu' => 'Modo de Criação das Regras'
    ])
@endsection

