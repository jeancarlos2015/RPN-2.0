@extends('layouts.modelagem.main_area_modelador2')


@section('content')
    <h3>Editar o Modelo</h3>

    @if(!empty($organizacao))
        <h2>Organização: <strong> {{$organizacao->nome}}</strong></h2>
    @endif
    <hr>
    @if(!empty($projeto))
        <h2>Projeto: <strong> {{$projeto->nome}}</strong></h2>
    @endif
    {{--@if(!empty($dado))--}}

        {{--<form action="{!! route('controle_modelos.store') !!}" method="post">--}}
            {{--@if($dado['tipo']=='declarativo')--}}
                {{--@includeIf('controle_modelos.form_declarativo',--}}
                        {{--[--}}
                        {{--'acao' => 'Criar Modelo',--}}
                        {{--'organizacao_id' => $dado['organizacao_id'],--}}
                        {{--'projeto_id' => $dado['projeto_id'],--}}
                        {{--'MAX' => 2--}}
                        {{--]--}}
                        {{--)--}}
            {{--@elseif($dado['tipo'] == 'diagramatico')--}}
                {{--@includeIf('controle_modelos.form_diagramatico',--}}
                        {{--[--}}
                        {{--'acao' => 'Criar Modelo',--}}
                        {{--'organizacao_id' => $dado['organizacao_id'],--}}
                        {{--'projeto_id' => $dado['projeto_id'],--}}
                        {{--'MAX' => 2--}}
                        {{--]--}}
                        {{--)--}}
            {{--@endif--}}

        {{--</form>--}}
    {{--@else--}}
        {{--<form action="{!! route('escolhe_modelo') !!}" method="post">--}}
            {{--@includeIf('controle_modelos.form_escolha',--}}
                    {{--[--}}
                    {{--'acao' => 'Criar Modelo',--}}
                    {{--'organizacao_id' => $organizacao->id,--}}
                    {{--'projeto_id' => $projeto->id,--}}
                    {{--'MAX' => 2--}}
                    {{--]--}}
                    {{--)--}}
        {{--</form>--}}
    {{--@endif--}}

    <H4>Atualização Modelo</H4>
    <form action="{!! route('controle_modelos.update',['id' => $modelo->id]) !!}" method="post">
        {{ method_field('PUT')}}
        @includeIf('controle_modelos.form',
                    [
                    'acao' => 'Atualizar e Proseguir',
                    'dados' => $dados,
                    'MAX' => 2,
                    'organizacao_id' => $organizacao->id,
                    'projeto_id' => $projeto->id
                    ]
                    )

    </form>
@endsection
