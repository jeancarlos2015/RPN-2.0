@extends('layouts.modelagem.main_area_modelador2')


@section('content')
    {!! csrf_field() !!}

    @includeIf('componentes.dados_exibicao')
    <h4>Controle De Modelos</h4>

    <br>
    @include('componentes.tabela_modelos',
                                [
                                'titulos' => $titulos,
                                'dados' => $modelos,
                                'rota_edicao' => 'controle_modelos.edit',
                                'rota_exclusao' => 'controle_modelos.destroy',
                                'rota_criacao' => 'controle_modelos_create',
                                'rota_exibicao_modelo' => 'controle_modelos.show',
                                'rota_exibicao_regras' => 'show_regras',
                                'rota_exibicao_tarefas' => 'show_tarefas',
                                'botao' => 'Criar Novo Modelo',
                                'parametro1' => 'organizacao_id',
                                'parametro2' => 'projeto_id',
                                'organizacao_id' => $organizacao->id,
                                'projeto_id' => $projeto->id,
                                'qt_parametros' => 4
                                ])
@endsection