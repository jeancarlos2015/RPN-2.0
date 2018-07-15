
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
        <div class="form-group">
            <div class="form-group">
                <label>Nome</label>
                <input type="text" class="form-control" name="nome" required>
            </div>

            <div class="form-group">
                <label>Operador</label>
                <input type="text" class="form-control" name="operador" required>
            </div>

            <input class="form-control btn btn-dark" value="Criar Operador" type="submit">
        </div>

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

    </form>
@endsection