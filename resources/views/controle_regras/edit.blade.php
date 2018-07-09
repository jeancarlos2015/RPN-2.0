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
    <h3>Editar Regra</h3>
    <form action="{!! route('controle_regras.update',['id' => $regra->id]) !!}" method="post">
        {{ method_field('PUT')}}
        @includeIf('controle_regras.form',
                                        [
                                        'acao' => 'Atualizar',
                                        'dados' => $dados,
                                        'MAX' => 4,
                                        'id' => $regra->id
                                        ]
                                        )
    </form>
@endsection
