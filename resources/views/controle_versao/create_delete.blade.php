@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                      'titulo' => 'Paianel',
                    'sub_titulo' => 'Versionamento',
                    'rota' => 'todas_tarefas',
                    'branch_atual' => $branch_atual
    ])

    <form action="{!! route('create') !!}" class="form-group">
        <div class="row">
            <div class="col-4"><label>Branch</label></div>
            <div class="col-4"><input type="text" class="form-control" name="branch" required></div>
            <div class="col-4"><input type="submit" class="btn btn-dark form-control" value="Create Branch"></div>
        </div>
    </form>

    @if(!empty($branchs))
        <form action="{!! route('delete') !!}" class="form-group">
            <div class="row">
                <div class="col-4"><label>Branch</label></div>
                <div class="col-4">
                    <select class="form-control" name="branch">
                        @foreach($branchs as $branch)
                            <option value="{!! $branch !!}"></option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4"><input type="submit" class="btn btn-dark form-control" value="Delete Branch"></div>
            </div>
        </form>
    @endif


@endsection