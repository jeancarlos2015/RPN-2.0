<form action="{!! route('controle_objetos_fluxos.update',[$objeto_fluxo->codobjetofluxo]) !!}" method="post">
    @method('PUT')
    @csrf
    @includeIf('controle_modelos_declarativos.controle_objetos_fluxo.form',
    [
    'acao' => 'Atualizar  e Prosseguir',
    'dados' => $dados,
    'MAX' => 2,
    'objeto_fluxo' => $objeto_fluxo
    ]
    )
</form>