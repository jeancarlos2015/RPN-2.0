@extends('layouts.modelagem.main_area_modelador2')


@section('content')
    {!! csrf_field() !!}
   @includeIf('componentes.dados_exibicao')
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
