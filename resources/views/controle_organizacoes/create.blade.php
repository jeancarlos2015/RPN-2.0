@extends('layouts.modelagem.main_area_modelador2')


@section('content')

    <h3>Nova Organização</h3>
    <form action="{!! route('controle_organizacoes.store') !!}" method="post">
        {{ method_field('POST')}}
        @includeIf('controle_organizacoes.form',['acao' => 'Salvar e Proseguir','dados' => $dados,'MAX' => 2])
    </form>

@endsection
