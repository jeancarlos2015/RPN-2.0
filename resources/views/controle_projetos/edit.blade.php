@extends('layouts.modelagem.main_area_modelador2')


@section('content')
    @includeIf('componentes.dados_exibicao')
    <H4>Novo Projeto</H4>
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
