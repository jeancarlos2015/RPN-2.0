
@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                      'titulo' => 'Painel',
                    'sub_titulo' => 'Tarefas',
                    'rota' => 'todas_tarefas'
    ])

    <form action="{!! route('controle_tarefas.update',['id' => $tarefa->codtarefa]) !!}" method="post">
    {{ method_field('PUT')}}
    @includeIf('controle_tarefas.form',
    [
    'acao' => 'Atualizar',
    'dados' => $dados,
    'MAX' => 2,
    'codtarefa' => $tarefa->codtarefa
    ]
    )
    </form>
@endsection
