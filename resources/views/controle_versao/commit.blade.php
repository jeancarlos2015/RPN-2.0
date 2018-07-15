@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                      'titulo' => 'Paianel',
                    'sub_titulo' => 'Versionamento',
                    'rota' => 'todas_tarefas',
                    'branch_atual' => $branch_atual
    ])

    <form action="{!! route('commit') !!}">
        <div class="row">
            <div class="col-4"><label>Mensagem</label></div>
            <div class="col-4"><input type="text" class="form-control" name="mensagem" required></div>
            <div class="col-4"><input type="submit" class="btn btn-dark form-control" value="Commit"></div>
        </div>

    </form>


@endsection