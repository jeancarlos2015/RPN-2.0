@extends('layouts.layout_admin_new.layouts.main')

@section('content')

    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                      'titulo' => 'Paianel',
                    'sub_titulo' => 'Versionamento',
                    'rota' => 'todas_tarefas',
                    'branch_atual' => $branch_atual
    ])
    <form action="{!! route('init') !!}" method="post">
        {!! csrf_field() !!}
        <div class="form-group">
            <label>Nome do repositório</label>
            <input type="text" name="nome" class="form-control" required>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-dark form-control" value="Criar Repositório">
        </div>
    </form>
    
    @if(!empty($repositorios))
        @includeIf('layouts.layout_admin_new.componentes.tables',[
                            'titulos' => $titulos,
                            'repositorios' => $repositorios,
                            'nome_botao' => 'Novo',
                            'titulo' =>'Repositórios'
            ])
    @endif
@endsection
