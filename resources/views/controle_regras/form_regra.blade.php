{{--@extends('layouts.layout_admin_new.layouts.main')--}}

{{--@section('content')--}}
    {{--{!! csrf_field() !!}--}}
    {{--@includeIf('layouts.layout_admin_new.componentes.breadcrumb',[--}}
                      {{--'titulo' => 'Modelos',--}}
                    {{--'sub_titulo' => 'Definição De Regras',--}}
                    {{--'rota' => 'todas_regras'--}}
    {{--])--}}
    {{--<form action="{!! route('controle_regras.store') !!}" method="post">--}}
        {{--{!! csrf_field() !!}--}}
        {{--{{ method_field('PUT')}}--}}
        {{--<div class="form-group">--}}
            {{--<div class="row">--}}

                {{--<div class="col-3">--}}
                    {{--<div class="form-group">--}}
                        {{--<label>Nome da regra</label>--}}
                        {{--<input type="text" name="nome_regra" class="form-control">--}}
                    {{--</div>--}}

                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="row">--}}

                {{--<div class="col-5">--}}

                    {{--<div class="form-group">--}}
                        {{--<label>Tarefa/Regra </label>--}}
                        {{--<input list="tarefa_ou_regra1" name="tarefa_ou_regra1" class="form-control">--}}
                        {{--<datalist id="tarefa_ou_regra1">--}}
                            {{--@if(!empty($regras))--}}
                                {{--@foreach($regras as $regra)--}}
                                    {{--<option value="{!! $regra->nome !!}" label="regra">{!! $regra->nome !!}</option>--}}
                                {{--@endforeach--}}
                            {{--@endif--}}
                            {{--@if(!empty($tarefas))--}}
                                {{--@foreach($tarefas as $tarefa)--}}
                                    {{--<option value="{!! $tarefa->nome !!}" label="tarefa">{!! $tarefa->nome !!}</option>--}}
                                {{--@endforeach--}}
                            {{--@endif--}}
                        {{--</datalist>--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                        {{--<input type="radio" name="tipo1" value="regra" checked>Regra--}}
                        {{--<input type="radio" name="tipo1" value="tarefa">Tarefa--}}
                    {{--</div>--}}

                {{--</div>--}}


                {{--<div class="col-2 ">--}}
                    {{--<label>Operador</label>--}}
                    {{--<input type="text" class="form-control text-center" name="operador" required>--}}
                {{--</div>--}}

                {{--<div class="col-5">--}}
                    {{--<div class="form-group">--}}
                        {{--<label>Tarefa/Regra</label>--}}
                        {{--<input list="tarefa_ou_regra2" name="tarefa_ou_regra2" class="form-control">--}}
                        {{--<datalist id="tarefa_ou_regra2">--}}
                            {{--@if(!empty($regras))--}}
                                {{--@foreach($regras as $regra1)--}}
                                    {{--<option value="{!! $regra1->nome !!}" label="regra">{!! $regra1->nome !!}</option>--}}
                                {{--@endforeach--}}
                            {{--@endif--}}
                            {{--@if(!empty($tarefas))--}}
                                {{--@foreach($tarefas as $tarefa1)--}}
                                    {{--<option value="{!! $tarefa1->nome !!}"--}}
                                            {{--label="tarefa">{!! $tarefa1->nome !!}</option>--}}
                                {{--@endforeach--}}
                            {{--@endif--}}
                        {{--</datalist>--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                        {{--<div class="form-group">--}}
                            {{--<input type="radio" name="tipo2" value="regra" checked>Regra--}}
                            {{--<input type="radio" name="tipo2" value="tarefa">Tarefa--}}
                        {{--</div>--}}
                    {{--</div>--}}


                {{--</div>--}}

            {{--</div>--}}
        {{--</div>--}}

        {{--<input type="hidden" name="tarefa1.descricao" value="Nenhum">--}}
        {{--<input type="hidden" name="tarefa2.descricao" value="Nenhum">--}}
        {{--@if(!empty($organizacao))--}}
            {{--<input type="hidden" name="codorganizacao" class="form-control"--}}
                   {{--value="{!! $organizacao->codorganizacao !!}">--}}
        {{--@endif--}}

        {{--@if(!empty($projeto))--}}
            {{--<input type="hidden" name="codprojeto" class="form-control"--}}
                   {{--value="{!! $projeto->codprojeto !!}">--}}
        {{--@endif--}}

        {{--@if(!empty($modelo))--}}
            {{--<input type="hidden" name="codmodelo" class="form-control"--}}
                   {{--value="{!! $modelo->codmodelo !!}">--}}
        {{--@endif--}}

        {{--@if(!empty($regra))--}}
            {{--<input type="hidden" name="codregra" class="form-control"--}}
                   {{--value="{!! $regra->codregra !!}">--}}
        {{--@endif--}}
        {{--<input class="btn btn-dark form-control" type="submit" value="Criar Regra">--}}
    {{--</form>--}}

    {{--@includeIf('layouts.layout_admin_new.componentes.tables',[--}}
                   {{--'titulos' => $titulos,--}}
                   {{--'regras' => $regras,--}}
                   {{--'rota_edicao' => 'controle_regras.edit',--}}
                   {{--'rota_exclusao' => 'controle_regras.destroy',--}}
                   {{--'nome_botao' => 'Novo',--}}
                   {{--'titulo' =>'Regras'--}}
   {{--])--}}

{{--@endsection--}}
