@extends('layouts.modelagem.main_area_modelador2')


@section('content')
    {!! csrf_field() !!}

    <h3>Controle De Organizações</h3>
    <br>
    @include('componentes.tabela',
                                 [
                                 'titulos' => $titulos,
                                 'dados' => $organizacoes,
                                 'rota_edicao' => 'controle_organizacoes.edit',
                                 'rota_exclusao' => 'controle_organizacoes.destroy',
                                 'rota_criacao' => 'controle_organizacoes.create',
                                 'rota_exibicao' => 'controle_organizacoes.show',
                                 'botao' => 'Criar Nova Organização',
                                 ])
@endsection