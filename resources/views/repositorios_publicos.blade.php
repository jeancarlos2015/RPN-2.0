{{--@extends('layouts.home.main')--}}
{{--@section('content')--}}

    {{--<div class="form-control">--}}
        {{--<div>--}}
            {{--<i class="fa fa-table"></i> Repositórios Públicos--}}
        {{--</div>--}}
        {{--<div>--}}
            {{--<div class="table-responsive">--}}
                {{--<div id="dataTable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-sm-12 col-md-6">--}}
                            {{--<div class="dataTables_length" id="dataTable_length"><label>Exibir <select--}}
                                            {{--name="dataTable_length" aria-controls="dataTable"--}}
                                            {{--class="form-control form-control-sm">--}}
                                        {{--<option value="5">5</option>--}}
                                    {{--</select> Registros</label></div>--}}
                        {{--</div>--}}
                        {{--<div class="col-sm-12 col-md-6">--}}
                            {{--<div id="dataTable_filter" class="dataTables_filter"><label>Search:<input type="search"--}}
                                                                                                         {{--class="form-control form-control-sm"--}}
                                                                                                         {{--placeholder=""--}}
                                                                                                         {{--aria-controls="dataTable"></label>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-sm-12">--}}
                            {{--<table class="table table-responsive dataTable" id="dataTable" width="100%" cellspacing="0"--}}
                                   {{--role="grid" aria-describedby="dataTable_info" style="width: 100%;">--}}
                                {{--<thead>--}}
                                {{--<tr role="row">--}}
                                    {{--<th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1"--}}
                                        {{--colspan="1" aria-sort="ascending"--}}
                                        {{--aria-label="Name: activate to sort column descending" style="width: 148px;">--}}
                                        {{--Repositório--}}
                                    {{--</th>--}}

                                {{--</tr>--}}
                                {{--</thead>--}}
                                {{--<tfoot>--}}
                                {{--<tr>--}}

                                    {{--<th rowspan="1" colspan="1">--}}
                                        {{--Repositório--}}
                                    {{--</th>--}}

                                {{--</tr>--}}
                                {{--</tfoot>--}}
                                {{--<tbody>--}}

                                {{--@foreach($repositorios_publicos as $repositorio)--}}
                                    {{--<tr role="row" class="odd">--}}

                                        {{--<td class="sorting_1">--}}
                                            {{--<a href="#">--}}
                                                {{--<div class="media">--}}
                                                    {{--<img class="d-flex mr-3 rounded-circle" src="{{ Gravatar::src('public/img/processo.png') }}"--}}
                                                         {{--alt="" width="100">--}}
                                                    {{--<div class="media-body">--}}
                                                        {{--<strong>{!!  $repositorio->nome !!}</strong>--}}
                                                        {{--<div class="text-muted smaller">Repositório: {!! $repositorio->nome !!}</div>--}}
                                                        {{--<div class="text-muted smaller">Usuários: {!! count($repositorio->usuarios) !!}</div>--}}
                                                        {{--<div class="text-muted smaller">Projetos: {!! count($repositorio->projetos) !!}</div>--}}
                                                        {{--<div class="text-muted smaller">Modelos: {!! count($repositorio->modelos_diagramaticos) !!}</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</a>--}}
                                        {{--</td>--}}

                                    {{--</tr>--}}
                                {{--@endforeach--}}
                                {{--</tbody>--}}
                            {{--</table>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-sm-12 col-md-5">--}}
                            {{--<div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">Exibindo--}}
                                {{--de 1 a--}}
                                {{--{!! count($repositorios_publicos) !!}--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-sm-12 col-md-7">--}}
                            {{--<div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">--}}
                                {{--<ul class="pagination">--}}
                                    {{--<li class="paginate_button page-item previous disabled" id="dataTable_previous"><a--}}
                                                {{--href="#" aria-controls="dataTable" data-dt-idx="0" tabindex="0"--}}
                                                {{--class="page-link">Previous</a></li>--}}

                                    {{--@for($indice=1;$indice<=count($repositorios_publicos);$indice++)--}}
                                    {{--<li class="paginate_button page-item active"><a href="#" aria-controls="dataTable"--}}
                                                                                    {{--data-dt-idx="{!! $indice !!}" tabindex="0"--}}
                                                                                    {{--class="page-link">{!! $indice !!}</a></li>--}}
                                    {{--@endfor--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}


{{--@endsection--}}
