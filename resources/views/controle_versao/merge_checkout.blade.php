@extends('layouts.layout_admin_new.layouts.main')

@section('content')

    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                      'titulo' => 'Paianel',
                    'sub_titulo' => 'Versionamento',
                    'rota' => 'todas_tarefas',
                    'branch_atual' => $branch_atual
    ])

    @if(!empty($branchs))
        <form action="{!! route('merge_checkout') !!}" method="post">
            {!! csrf_field() !!}
            <label>Branch</label>
            <select name="branch" class="form-control">
                @foreach($branchs as $branch)
                    <option value="{!! $branch !!}">{!! $branch !!}</option>
                @endforeach
            </select>

            <div class="form-group form-control">
                <input type="radio" name="tipo" value="checkout"> Checkout
            </div>
            <div class="form-group form-control">
                <input type="radio" name="tipo" value="merge">Merge
            </div>
            <div class="form-group"><input type="submit" class="btn btn-dark form-control" value="Executar"></div>

        </form>
    @endif


@endsection