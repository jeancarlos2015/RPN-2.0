@extends('layouts.layout_admin_new.layouts.main')

@section('content')

    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                      'titulo' => 'Painel',
                    'sub_titulo' => 'Versionamento',
                    'rota' => 'painel',
                    'branch_atual' => $branch_atual
    ])


    @if(!empty($repositorios))

        @if(Auth::user()->email==='jeancarlospenas25@gmail.com')
            <form action="{!! route('init') !!}" method="post">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label>Nome da Base</label>
                    <input type="text" name="nome" class="form-control" required>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-dark form-control" value="Criar Base">
                </div>
            </form>
            @includeIf('layouts.layout_admin_new.componentes.tables',[
                                'titulos' => $titulos,
                                'repositorios' => $repositorios,
                                'nome_botao' => 'Novo',
                                'titulo' =>'Repositórios'
                ])
        @else
            @includeIf('layouts.layout_admin_new.componentes.tables',[
                                'titulos' => $titulos,
                                'repositorios' => $repositorios,
                                'titulo' =>'Repositórios'
                ])
        @endif
    @endif
@endsection
