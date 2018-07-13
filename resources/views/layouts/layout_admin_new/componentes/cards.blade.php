<!-- Icon Cards-->
<div class="row">

    @if(!empty($tipo))
        @if($tipo === 'versionamento')


        @elseif($tipo === 'painel')
            {{--{!! dd($titulos, $quantidades, $rotas) !!}--}}
            @if(!empty($titulos) && !empty($quantidades) && !empty($rotas))
                @for($index=0;$index<count($titulos);$index++)
                    @includeIf('layouts.layout_admin_new.componentes.card',

                    [
                            'quantidade' => $quantidades[$index],
                            'titulo' => $titulos[$index],
                            'rota' => $rotas[$index]
                    ])
                @endfor

            @endif

        @endif

    @endif
</div>