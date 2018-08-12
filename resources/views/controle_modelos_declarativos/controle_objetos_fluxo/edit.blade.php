
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
@endsection
