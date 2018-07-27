@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                      'titulo' => 'Painel',
                    'sub_titulo' => 'Projetos',
                    'rota' => 'todos_projetos'
    ])
    <form action="{!! route('controle_projetos.update',['id' => $projeto->codprojeto]) !!}" method="post">
        {{ method_field('PUT')}}
        @includeIf('controle_projetos.form',
                                        [
                                        'acao' => 'Salvar e Proseguir',
                                        'dados' => $dados,
                                        'MAX' => 2,
                                        'codorganizacao' => $organizacao->codorganizacao
                                        ]
                                        )
    </form>
@endsection
