@extends('layouts.modelagem.main_area_modelador2')


@section('content')
    {!! csrf_field() !!}
    @includeIf('componentes.dados_exibicao')
    <hr>
    <h3>Nova Regra</h3>
    <form action="{!! route('controle_regras.store') !!}" method="post">
        @includeIf('controle_regras.form',
                   [
                   'acao' => 'Criar Regra',
                   'dados' => $dados,
                   'MAX' => 4,
                   'projeto_id' => $projeto->id,
                   'modelo_id' => $modelo->id,
                   'organizacao_id' => $organizacao->id,
                   'tarefas' => $tarefas
                   ]
                   )
    </form>
@endsection
