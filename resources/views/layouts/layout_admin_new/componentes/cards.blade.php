<!-- Icon Cards-->
<div class="row">
    {{--<div class="col-xl-3 col-sm-6 mb-3">--}}
    {{--<div class="card text-white bg-primary o-hidden h-100">--}}
    {{--<div class="card-body">--}}
    {{--<div class="card-body-icon">--}}
    {{--<i class="fa fa-fw fa-comments"></i>--}}
    {{--</div>--}}
    {{--<div class="mr-5">50 Modelos</div>--}}
    {{--</div>--}}
    {{--<a class="card-footer text-white clearfix small z-1" href="#">--}}
    {{--<span class="float-left">Visualizar</span>--}}
    {{--<span class="float-right">--}}
    {{--<i class="fa fa-angle-right"></i>--}}
    {{--</span>--}}
    {{--</a>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="col-xl-3 col-sm-6 mb-3">--}}
    {{--<div class="card text-white bg-warning o-hidden h-100">--}}
    {{--<div class="card-body">--}}
    {{--<div class="card-body-icon">--}}
    {{--<i class="fa fa-fw fa-list"></i>--}}
    {{--</div>--}}
    {{--<div class="mr-5">60 Tarefas</div>--}}
    {{--</div>--}}
    {{--<a class="card-footer text-white clearfix small z-1" href="#">--}}
    {{--<span class="float-left">Visualizar</span>--}}
    {{--<span class="float-right">--}}
    {{--<i class="fa fa-angle-right"></i>--}}
    {{--</span>--}}
    {{--</a>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="col-xl-3 col-sm-6 mb-3">--}}
    {{--<div class="card text-white bg-danger o-hidden h-100">--}}
    {{--<div class="card-body">--}}
    {{--<div class="card-body-icon">--}}
    {{--<i class="fa fa-fw fa-support"></i>--}}
    {{--</div>--}}
    {{--<div class="mr-5">50 Regras</div>--}}
    {{--</div>--}}
    {{--<a class="card-footer text-white clearfix small z-1" href="#">--}}
    {{--<span class="float-left">Visualizar</span>--}}
    {{--<span class="float-right">--}}
    {{--<i class="fa fa-angle-right"></i>--}}
    {{--</span>--}}
    {{--</a>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="col-xl-3 col-sm-6 mb-3">--}}
    {{--<div class="card text-white bg-dark o-hidden h-100">--}}
    {{--<div class="card-body">--}}
    {{--<div class="card-body-icon">--}}
    {{--<i class="fa fa-fw fa-list"></i>--}}
    {{--</div>--}}
    {{--<div class="mr-5">60 Projetos</div>--}}
    {{--</div>--}}
    {{--<a class="card-footer text-white clearfix small z-1" href="#">--}}
    {{--<span class="float-left">Visualizar</span>--}}
    {{--<span class="float-right">--}}
    {{--<i class="fa fa-angle-right"></i>--}}
    {{--</span>--}}
    {{--</a>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="col-xl-3 col-sm-6 mb-3">--}}
    {{--<div class="card text-white bg-dark o-hidden h-100">--}}
    {{--<div class="card-body">--}}
    {{--<div class="card-body-icon">--}}
    {{--<i class="fa fa-fw fa-list"></i>--}}
    {{--</div>--}}
    {{--<div class="mr-5">60 Organizações</div>--}}
    {{--</div>--}}
    {{--<a class="card-footer text-white clearfix small z-1" href="#">--}}
    {{--<span class="float-left">Visualizar</span>--}}
    {{--<span class="float-right">--}}
    {{--<i class="fa fa-angle-right"></i>--}}
    {{--</span>--}}
    {{--</a>--}}
    {{--</div>--}}
    {{--</div>--}}

    @if(!empty($tipo))

        @if($tipo === 'versionamento')

                @foreach($projetos as $projeto)
                    <div class="col-xl-3 col-sm-6 mb-3">
                        <div class="card text-white bg-dark o-hidden h-100">
                            <div class="card-body">
                                <div class="card-body-icon">
                                    <i class="fa fa-fw fa-list"></i>
                                </div>
                                <div class="mr-5">Projeto: {!! $projeto->nome !!}</div>
                                <div class="mr-5">Descrição: {!! $projeto->descricao !!}</div>
                            </div>
                            <a class="card-footer text-white clearfix small z-1" href="{!! route('controle_projetos.show',[$projeto->id]) !!}">
                                <span class="float-left">Visualizar</span>
                                <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
                            </a>
                            <a class="card-footer text-white clearfix small z-1" href="{!! route('controle_projetos.show',[$projeto->id]) !!}">
                                {{--<span class="float-left">Visualizar</span>--}}
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Marcar</label>
                                </div>
                                <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
                            </a>

                        </div>
                    </div>
                @endforeach


        @endif
    @else
        @if(!empty($titulos) && !empty($quantidade) && !empty($rotas))
            @for($index=0;$index<count($titulos);$index++)
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-dark o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fa fa-fw fa-list"></i>
                            </div>
                            <div class="mr-5">{!! $quantidades[$index] !!} {!! $titulos[$index] !!}</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="{!! route($rotas[$index]) !!}">
                            <span class="float-left">Visualizar</span>
                            <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
                        </a>
                    </div>
                </div>
            @endfor

        @endif

    @endif
</div>