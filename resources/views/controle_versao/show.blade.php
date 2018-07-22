{{--@extends('layouts.modelagem.main_area_modelador2')--}}


{{--@section('content')--}}
{{--@includeIf('componentes.dados_exibicao')--}}
{{--<H4>Novo Projeto</H4>--}}
{{--<form action="{!! route('controle_projetos.update',['id' => $projeto->codprojeto]) !!}" method="post">--}}
{{--{{ method_field('PUT')}}--}}
{{--@includeIf('controle_projetos.form',--}}
{{--[--}}
{{--'acao' => 'Salvar e Proseguir',--}}
{{--'dados' => $dados,--}}
{{--'MAX' => 2,--}}
{{--'codorganizacao' => $organizacao->codorganizacao--}}
{{--]--}}
{{--)--}}
{{--</form>--}}
{{--@endsection--}}


@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @if(!empty($repositorio))
        @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                          'titulo' => 'Paianel',
                        'sub_titulo' => 'Versionamento',
                        'rota' => 'index_painel',
                        'branch_atual' => $repositorio['default_branch']
        ])


        <div class="form-group">
            <label>Nome Do Repositório</label>
            <input type="text" class="form-control" value="{!! $repositorio['name'] !!}" disabled>
        </div>

        <div class="form-group">
            <label>Nome Do Usuário</label>
            <input type="text" class="form-control" value="{!! $repositorio['owner']['login'] !!}" disabled>
        </div>

        <div class="form-group">
            <label>Git Do Repositório</label>
            <input type="text" class="form-control" value="{!! $repositorio['git_url'] !!}" disabled>
        </div>

    @endif
@endsection
