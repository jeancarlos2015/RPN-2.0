@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                    'titulo' => 'Painel',
                    'sub_titulo' => 'Documentações',
                    'rota' => 'painel'
    ])

    <form action="{!! route('controle_documentacoes.update',[$documentacao->coddocumentacao]) !!}" method="POST">
        @method('PUT')
        @includeIf('controle_documentacao.form',['acao' => 'Atualizar','dados' => $dados,'MAX' => 3])
    </form>

@endsection
