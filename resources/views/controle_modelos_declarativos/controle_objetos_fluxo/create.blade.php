
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
        ]
        )
    </form>
@endsection
