@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
              'titulo' => 'Paianel',
              'sub_titulo' => 'Nova Documentação',
    ])

    <form action="{!! route('controle_documentacoes.store') !!}" method="post">
        {{ method_field('POST')}}
        @includeIf('controle_documentacao.form',['acao' => 'Criar Documentação','dados' => $dados,'MAX' => 3])
    </form>

@endsection
