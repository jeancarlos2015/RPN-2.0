@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                      'titulo' => 'Painel',
                    'sub_titulo' => 'Repositório/'.$repositorio->nome.'/Projetos/'.$projeto->nome,
                    'rota' => 'todos_projetos'
    ])
    <form action="{!! route('controle_projetos.update',['id' => $projeto->codprojeto]) !!}" method="post">
        @method('PUT')
        @includeIf('controle_projetos.form',
                                        [
                                        'acao' => 'Salvar e Proseguir',
                                        'dados' => $dados,
                                        'MAX' => 2,
                                        'codrepositorio' => $repositorio->codrepositorio
                                        ]
                                        )
    </form>
@endsection
