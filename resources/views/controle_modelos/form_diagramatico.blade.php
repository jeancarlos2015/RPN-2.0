{{--@extends('layouts.modelagem.main_area_modelador2')--}}

{{--@section('content')--}}
    {{--<h4>Modelo Diagramático</h4>--}}

{{--@endsection--}}

@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                    'titulo' => 'Modelo Disgramático'
    ])

@endsection