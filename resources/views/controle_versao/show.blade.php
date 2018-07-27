@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @if(!empty($repositorio))
        @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                          'titulo' => 'Painel',
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
