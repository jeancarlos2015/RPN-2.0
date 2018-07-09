@extends('layouts.modelagem.main_area_modelador2')


@section('content')

    @if(!empty($organizacao))
        <h2>Organização: <strong> {{$organizacao->nome}}</strong></h2>
    @endif
    <H4>Novo Modelo</H4>

    <form action="{!! route('controle_modelos.store') !!}" method="post">
        @includeIf('controle_modelos.form',
                    [
                    'acao' => 'Salvar e Proseguir',
                    'dados' => $dados,
                    'MAX' => 2,
                    'organizacao_id' => $organizacao->id,
                    'projeto_id' => $projeto->id
                    ]
                    )

    </form>

@endsection
