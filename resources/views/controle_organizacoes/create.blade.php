{{--@extends('layouts.modelagem.main_area_modelador2')--}}


{{--@section('content')--}}

{{--<h3>Nova Organização</h3>--}}


{{--@endsection--}}

@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
              'titulo' => 'Paianel',
              'sub_titulo' => 'Nova Organização',
    ])

    <form action="{!! route('controle_organizacoes.store') !!}" method="post">
        {{ method_field('POST')}}
        @includeIf('controle_organizacoes.form',['acao' => 'Salvar e Proseguir','dados' => $dados,'MAX' => 2])
    </form>

@endsection