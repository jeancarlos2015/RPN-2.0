@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                      'titulo' => 'Painel',
                    'sub_titulo' => 'Versionamento',
                    'rota' => 'todas_tarefas',
                    'branch_atual' => $branch_atual
    ])

    <form action="{!! route('reset_files') !!}" class="form-group" method="post">
    {!! csrf_field() !!}
    <div class="col-4"><input type="submit" class="btn btn-dark form-control" value="Executar"></div>
    </form>

    {{--<form action="{!! route('reset_files') !!}" class="form-group" method="post" enctype="multipart/form-data">--}}
        {{--{!! csrf_field() !!}--}}
        {{--<div class="form-group">--}}
            {{--<div class="form-group">--}}
                {{--<input type="text" name="nome">--}}
            {{--</div>--}}
            {{--<div class="form-group">--}}
                {{--<input type="file" name="foo" value=""/>--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<div class="form-group"><input type="submit" class="btn btn-dark form-control" value="Upload"></div>--}}
    {{--</form>--}}

@endsection
