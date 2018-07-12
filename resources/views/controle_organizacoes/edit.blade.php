@extends('layouts.modelagem.main_area_modelador2')


@section('content')
    <h3>Editar o Projeto</h3>
    <form action="{!! route('controle_organizacoes.update',[$organizacao->codorganizacao]) !!}" method="POST">
        {{ method_field('PUT')}}
        @includeIf('controle_organizacoes.form',['acao' => 'Atualizar e Proseguir','dados' => $dados,'MAX' => 2])
    </form>
@endsection
