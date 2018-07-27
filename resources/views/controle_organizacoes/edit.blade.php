@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                    'titulo' => 'Painel',
                    'sub_titulo' => 'Organizacoes',
                    'rota' => 'controle_organizacoes.index'
    ])

    <form action="{!! route('controle_organizacoes.update',[$organizacao->codorganizacao]) !!}" method="POST">
    {{ method_field('PUT')}}
    @includeIf('controle_organizacoes.form',['acao' => 'Atualizar e Proseguir','dados' => $dados,'MAX' => 2])
    </form>

@endsection
