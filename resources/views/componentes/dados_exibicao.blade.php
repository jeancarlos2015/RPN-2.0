<div class="row">
    <div class="card card-box text-left float-left">

        <div class="card-body">

            @csrf

            <div class="form-group">
                <div class="card-header dark-text-white"><strong>Dados Da Organização</strong></div>
                @if(!empty($organizacao))
                    <span>Organização: <strong style="margin-left: 50px"> {{$organizacao->nome}}</strong></span>
                @endif

                @if(!empty($projeto))
                    <span style="margin-left: 50px">Projeto: <strong style="margin-left: 50px"> {{$projeto->nome}}</strong></span>
                @endif

            </div>

            <div class="form-group">
                @if(!empty($modelo))
                    <div class="card-header dark-text-white"><strong>Modelo</strong></div>
                    <span2>Nome: <strong style="margin-left: 50px"> {{$modelo->nome}}</strong></span2>
                    <span2 style="margin-left: 50px">Tipo: <strong style="margin-left: 50px"> {{$modelo->tipo}}</strong></span2>
                @endif

            </div>

        </div>
    </div>
</div>