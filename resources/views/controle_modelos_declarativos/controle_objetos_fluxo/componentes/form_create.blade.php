<form action="{!! route('controle_objetos_fluxos.store') !!}" method="post">
    @csrf
    @method('POST')
    @includeIf('controle_modelos_declarativos.controle_objetos_fluxo.form',
    [
    'acao' => 'Criar Objeto de Fluxo',
    'dados' => $dados,
    'MAX' => 2
    ])
</form>