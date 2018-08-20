@if(!empty($nomebotao))
    {{--<a class="btn" ><span class="glyphicon glyphicon-eye-open"></span>{!! $nomebotao !!}</a>--}}
    <div class="form-group">
        <a href="{!! route($rota,[$id]) !!}"><img src="{!! asset('img/olho.png') !!} " style="width: 20px"
                                                  title="Visualizar"></a>
    </div>
@elseif(!empty($edite_vinculo))
    <div class="form-group">
        <a href="{!! route($rota,[$id]) !!}"><img src="{!! asset('img/edit_vinculo.png') !!} " style="width: 20px"
                                                  title="Editar Vinculo"></a>
    </div>
@else
    {{--<a class="btn btn-warning" href="{!! route($rota,[$id]) !!}">Editar</a>--}}
    <div class="form-group">
        <a href="{!! route($rota,[$id]) !!}"><img src="{!! asset('img/edite.png') !!} " style="width: 20px"
                                                  title="Editar"></a>
    </div>
@endif

