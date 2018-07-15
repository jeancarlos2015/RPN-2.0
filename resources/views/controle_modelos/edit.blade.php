@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                    'titulo' => 'Paianel',
                    'sub_titulo' => 'Edição do Modelo',
                    'rota' => 'controle_organizacoes.index'
    ])

    <form action="{!! route('controle_modelos.update',['id' => $modelo->codmodelo]) !!}" method="post">
    {{ method_field('PUT')}}
    @includeIf('controle_modelos.form',
    [
    'acao' => 'Atualizar e Proseguir',
    'dados' => $dados,
    'MAX' => 2,
    'organizacao_id' => $organizacao->codorganizacao,
    'projeto_id' => $projeto->codprojeto
    ]
    )

    </form>


@endsection