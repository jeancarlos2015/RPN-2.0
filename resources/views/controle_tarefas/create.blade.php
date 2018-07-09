@extends('layouts.modelagem.main_area_modelador2')


@section('content')
    {!! csrf_field() !!}
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
    <h3>Nova Tarefa</h3>
    <form action="{!! route('controle_tarefas.store') !!}" method="post">
        @includeIf('controle_tarefas.form',
                   [
                   'acao' => 'Criar Tarefa',
                   'dados' => $dados,
                   'MAX' => 2,
                   'projeto_id' => $projeto->id,
                   'modelo_id' => $modelo->id,
                   'organizacao_id' => $organizacao->id
                   ]
                   )
    </form>
@endsection
