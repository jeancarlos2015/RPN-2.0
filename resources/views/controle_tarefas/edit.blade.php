@extends('layouts.modelagem.main_area_modelador2')


@section('content')
    @if(!empty($organizacao))
        <span>Organização: <strong> {{$organizacao->nome}}</strong></span>
    @endif
    <hr>
    @if(!empty($projeto))
        <span>Projeto: <strong> {{$projeto->nome}}</strong></span>
    @endif
    <hr>
    @if(!empty($modelo))
        <span2>Modelo: <strong> {{$modelo->nome}}</strong></span2>
        <hr>
        <span2>Tipo: <strong> {{$modelo->tipo}}</strong></span2>
    @endif
    <hr>
    <h3>Editar Tarefa</h3>
    <form action="{!! route('controle_tarefas.update',['id' => $tarefa->id]) !!}" method="post">
        {{ method_field('PUT')}}
        @includeIf('controle_tarefas.form',
                                        [
                                        'acao' => 'Atualizar',
                                        'dados' => $dados,
                                        'MAX' => 2,
                                        'id' => $tarefa->id
                                        ]
                                        )
    </form>
@endsection
