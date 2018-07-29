@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                      'titulo' => 'Modelos',
                    'sub_titulo' => 'Definição De Regras',
                    'rota' => 'todas_regras'
    ])
    <form action="{!! route('controle_regras.store') !!}" method="post">
        {!! csrf_field() !!}
        {{--{{ method_field('PUT')}}--}}
        <div class="form-group">
            <div class="row">
                <div class="col-5">
                    <input list="tarefa_ou_regra1" name="tarefa_ou_regra1" class="form-control">
                    <datalist id="tarefa_ou_regra1">
                        @if(!empty($regras))
                            @foreach($regras as $regra)
                                <option value="{!! $regra->codregra !!}" label="teste"></option>
                            @endforeach
                        @endif
                    </datalist>
                </div>


                <div class="col-2 "><input type="text" class="form-control text-center" name="operador" required></div>

                <div class="col-5">
                    <input list="tarefa_ou_regra2" name="tarefa_ou_regra2" class="form-control">
                    <datalist id="tarefa_ou_regra2">
                        @if(!empty($regras))
                            @foreach($regras as $regra)
                                <option value="{!! $regra->codregra !!}">{!! $regra->nome !!}</option>
                            @endforeach
                        @endif
                    </datalist>
                </div>

                {{--<div class="col-2"><input type="text" class="form-control" name="nome" placeholder="Nome da regra" required></div>--}}
                {{--<div class="col-4"><input type="text" class="form-control" name="tarefa1.nome" placeholder="Tarefa 1" required></div>--}}
                {{--<div class="col-2 "><input type="text" class="form-control text-center" name="operador" required></div>--}}
                {{--<div class="col-4 "><input type="text"  class="form-control" name="tarefa2.nome" placeholder="Tarefa 2" required></div>--}}
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

    @includeIf('layouts.layout_admin_new.componentes.tables',[
                   'titulos' => $titulos,
                   'regras' => $regras,
                   'rota_edicao' => 'controle_regras.edit',
                   'rota_exclusao' => 'controle_regras.destroy',
                   'nome_botao' => 'Novo',
                   'titulo' =>'Regras'
   ])

@endsection
