<script src="{!! asset('jquery_select/jquery-1.11.1.min.js') !!}"></script>


@if(!empty($multi))


    <label>Nome da regra</label>
    <input type="text" class="form-control" name="nome" required>


    <div class="row">
        @includeIf('controle_modelos_declarativos.controle_regras.componentes.select_objetos_fluxo',[
            'multi' => 'true'
        ])
    </div>
    <div class="row">
        @includeIf('controle_modelos_declarativos.controle_regras.componentes.botoes_select')
    </div>
    <div class="row">
        @includeIf('controle_modelos_declarativos.controle_regras.componentes.selec_objetos_fluxo_nenhum',[
            'multi' => 'true'
        ])
    </div>


@else

    <div class="row">
        @includeIf('controle_modelos_declarativos.controle_regras.componentes.select_objetos_fluxo')

        @includeIf('controle_modelos_declarativos.controle_regras.componentes.botoes_select')

        @includeIf('controle_modelos_declarativos.controle_regras.componentes.selec_objetos_fluxo_nenhum')
    </div>
@endif

{{--'codrepositorio',--}}
{{--'codusuario',--}}
{{--'codprojeto',--}}
{{--'codmodelodeclarativo',--}}

<input type="hidden" value="{!! $modelo_declarativo->codrepositorio !!}" name="codrepositorio">
<input type="hidden" value="{!! $modelo_declarativo->codusuario !!}" name="codusuario">
<input type="hidden" value="{!! $modelo_declarativo->codprojeto !!}" name="codprojeto">
<input type="hidden" value="{!! $modelo_declarativo->codmodelodeclarativo !!}" name="codmodelodeclarativo">

{{--'visivel_projeto',--}}
{{--'visivel_modelo_declarativo',--}}
{{--'visivel_repositorio'--}}
