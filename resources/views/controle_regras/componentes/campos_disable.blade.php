<div class="card">
    <div class="card-header">Descrição da regra</div>
    <div class="card-body">

        <div class="form-group form-control">
            <label>Descrição</label>
            <input type="text" value="{!! $regra->projeto->nome !!}" disabled class="form-control">

            <label>Projeto</label>
            <input type="text" value="{!! $regra->projeto->nome !!}" disabled class="form-control">

            <label>Repositório</label>
            <input type="text" value="{!! $regra->repositorio->nome !!}" disabled class="form-control">

            <label>Modelo Declarativo</label>
            <input type="text" value="{!! $regra->modelodeclarativo->nome !!}" disabled class="form-control">

            <label>Responsável</label>
            <input type="text" value="{!! $regra->usuario->name !!}" disabled class="form-control">

            <label>Regra</label>
            <input type="text" value="{!! \App\http\Models\Regra::PADROES[$regra->relacionamento] !!}" disabled
                   class="form-control">
        </div>
    </div>
    <div class="card-header">Objetos Fluxos Pertencente a Regra</div>
    <div class="card-body">
        <div class="form-group form-control">
            @foreach($regra->objetos_fluxos as $objeto)
                <input type="text" value="{!! $objeto->nome !!}" class="form-control" disabled>
            @endforeach
        </div>
    </div>
</div>
