<form action="{!! route('controle_padroes_recomendacao.store') !!}" method="post">
    @method('POST')
    @csrf
    @if($tipo_operacao==='conjunto')
        @includeIf('controle_modelos_declarativos.controle_regras.form_para_conjunto')
    @elseif($tipo_operacao==='binario')
        @includeIf('controle_modelos_declarativos.controle_regras.form_para_binario')
    @endif
</form>