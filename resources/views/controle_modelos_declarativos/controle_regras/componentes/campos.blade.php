<script src="{!! asset('jquery_select/jquery-1.11.1.min.js') !!}"></script>


<div class="row">
    @includeIf('controle_modelos_declarativos.controle_regras.componentes.select_objetos_fluxo')

    @includeIf('controle_modelos_declarativos.controle_regras.componentes.botoes_select')

    @includeIf('controle_modelos_declarativos.controle_regras.componentes.select_objetos_fluxo')


</div>
@if(!empty($padrao))
    @includeIf('controle_modelos_declarativos.controle_regras.componentes.select_padroes_conjunto')
@else


    @includeIf('controle_modelos_declarativos.controle_regras.componentes.select_padroes_binario')
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
