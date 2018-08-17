<!-- Icon Cards-->
<div class="row">
    @if(!empty($funcionalidades))
        @for($indice=0;$indice<count($funcionalidades);$indice++)
            @includeIf('layouts.admin.componentes.card',

            [
                    'funcionalidade' => $funcionalidades[$indice]
            ])
        @endfor
    @else
        @if(!empty($tipo))
            @if($tipo === 'versionamento')


            @elseif($tipo === 'painel')
                {{--{!! dd($titulos, $quantidades, $rotas) !!}--}}
                @if(!empty($titulos) && !empty($quantidades) && !empty($rotas))
                    @for($index=0;$index<count($titulos);$index++)
                        @includeIf('layouts.admin.componentes.card',

                        [
                                'quantidade' => $quantidades[$index],
                                'titulo' => $titulos[$index],
                                'rota' => $rotas[$index]
                        ])
                    @endfor

                @endif

            @endif

        @endif
    @endif

</div>