{{--@extends('controle_modelos_diagramaticos.layout_diagrama.main')--}}
{{--@section('content')--}}

{{--<div id="canvas"></div>--}}
{{--@endsection--}}

{{--@section('boltao_voltar')--}}

{{--<li class="nav-item">--}}

{{--<a class="nav-link"--}}
{{--href="{{ URL::previous() }}">--}}
{{--<p class="fa fa-mail-reply"> Retornar</p>--}}
{{--<span class="sr-only"></span>--}}
{{--</a>--}}
{{--</li>--}}

{{--@endsection--}}

{{--@section('codigo_canvas_js')--}}
{{--<script src="{{asset('bpmn/bpmn_visualizacao.js')}}"></script>--}}
{{--@endsection--}}

{{--@section('codigo_canvas_css')--}}
{{--<link href="{{asset('css/bpmn/bpmn.css')}}" rel="stylesheet">--}}
{{--@endsection--}}


@extends('controle_modelos_diagramaticos.layout_diagrama_visualizacao.main')

@section('canvas')
    <div id="canvas"></div>
@endsection

@section('boltao_voltar')

    <li class="nav-item">

        <a class="nav-link"
           href="{{ URL::previous() }}">
            <p class="fa fa-mail-reply"> Retornar</p>
            <span class="sr-only"></span>
        </a>
    </li>
@endsection

@section('codigo_js_bpmn')
    {{--<script src="{{asset('bpmn/bpmn.js')}}"></script>--}}
    <script src="{{asset('bpmn-app/dist/app.js')}}"></script>
@endsection