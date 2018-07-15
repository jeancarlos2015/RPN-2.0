@extends('layouts.layout_admin_new.layouts.main')

@section('content')

    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                      'titulo' => 'Paianel',
                    'sub_titulo' => 'Tarefas',
                    'rota' => 'todas_tarefas'
    ])

    <form action="{!! route('controle_tarefas.store') !!}" method="post">
        {!! csrf_field() !!}
        {{--{{ method_field('PUT')}}--}}
        <div class="form-group">
            <div class="row">
                <div class="col-3"><input type="text" name="tarefa1.nome" placeholder="Tarefa 1"></div>
                <div class="col-6">
                    <input type="text" class="form-control text-center" value="{!! $regra->operador !!}" name="operador" disabled>
                </div>
                <div class="col-3"><input type="text" name="tarefa2.nome" placeholder="Tarefa 2"></div>
            </div>
        </div>

        <input type="hidden" name="tarefa1.descricao" value="Nenhum">
        <input type="hidden" name="tarefa2.descricao" value="Nenhum">
        @if(!empty($organizacao))
            <input type="hidden" name="codorganizacao" class="form-control"
                   value="{!! $organizacao->codorganizacao !!}">
        @endif

        @if(!empty($projeto))
            <input type="hidden" name="codprojeto" class="form-control"
                   value="{!! $projeto->codprojeto !!}">
        @endif

        @if(!empty($modelo))
            <input type="hidden" name="codmodelo" class="form-control"
                   value="{!! $modelo->codmodelo !!}">
        @endif

        @if(!empty($regra))
            <input type="hidden" name="codregra" class="form-control"
                   value="{!! $regra->codregra !!}">
        @endif
        <input class="btn btn-dark form-control" type="submit" value="Criar Regra">
    </form>
@endsection