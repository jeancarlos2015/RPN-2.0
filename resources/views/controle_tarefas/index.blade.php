@extends('layouts.modelagem.main_area_modelador2')


@section('content')
    {!! csrf_field() !!}
    @includeIf('componentes.dados_exibicao')
    <h3>Controle De Tarefas</h3>
    <br>
    @include('componentes.tabela',
                                 [
                                 'titulos' => $titulos,
                                 'dados' => $tarefas,
                                 'rota_edicao' => 'controle_tarefas.edit',
                                 'rota_exclusao' => 'controle_tarefas.destroy',
                                 'rota_criacao' => 'controle_tarefas_create',
                                 'botao' => 'Criar Nova Tarefa',
                                  'qt_parametros' => 5,
                                  'modelo_id' => $modelo->id,
                                  'projeto_id' => $projeto->id,
                                  'organizacao_id' => $organizacao->id,
                                  'parametro1' => 'organizacao_id',
                                  'parametro2' => 'projeto_id',
                                  'parametro3' => 'modelo_id',
                                 ])

    {{--[$parametro1 => $organizacao_id, $parametro2 => $projeto_id,$parametro3 => $modelo_id]--}}
@endsection