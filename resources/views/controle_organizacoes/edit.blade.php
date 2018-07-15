{{--@extends('layouts.modelagem.main_area_modelador2')--}}


{{--@section('content')--}}
    {{--<h3>Editar o Projeto</h3>--}}
    {{--<form action="{!! route('controle_organizacoes.update',[$organizacao->codorganizacao]) !!}" method="POST">--}}
        {{--{{ method_field('PUT')}}--}}
        {{--@includeIf('controle_organizacoes.form',['acao' => 'Atualizar e Proseguir','dados' => $dados,'MAX' => 2])--}}
    {{--</form>--}}
{{--@endsection--}}


@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                    'titulo' => 'Paianel',
                    'sub_titulo' => 'Organizacoes',
                    'rota' => 'controle_organizacoes.index'
    ])

    <form action="{!! route('controle_organizacoes.update',[$organizacao->codorganizacao]) !!}" method="POST">
    {{ method_field('PUT')}}
    @includeIf('controle_organizacoes.form',['acao' => 'Atualizar e Proseguir','dados' => $dados,'MAX' => 2])
    </form>

@endsection