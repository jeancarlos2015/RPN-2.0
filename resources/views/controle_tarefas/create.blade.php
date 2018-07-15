
@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                      'titulo' => 'Paianel',
                    'sub_titulo' => 'Tarefas',
                    'rota' => 'todas_tarefas'
    ])

    <form action="{!! route('controle_regras.store') !!}" method="post">
        @includeIf('controle_tarefas.form',
        [
        'acao' => 'Criar Tarefa',
        'dados' => $dados,
        'MAX' => 2,
        'codprojeto' => $projeto->codprojeto,
        'codmodelo' => $modelo->codmodelo,
        'codorganizacao' => $organizacao->codorganizacao
        ]
        )
    </form>
@endsection