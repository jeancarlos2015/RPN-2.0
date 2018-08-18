<!-- Example DataTables Card-->
<div class="card mb-3">
    <div class="card-header">
        @if(!empty($titulo))
            <i class="fa fa-table"></i> {!! $titulo !!}
        @endif
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    @includeIf('layouts.admin.componentes.tables_titulos')
                </tr>
                </thead>

                <tfoot>
                @includeIf('layouts.admin.componentes.tables_titulos')
                </tfoot>
                @switch($tipo)
                    @case('objetofluxo')
                    @includeIf('layouts.admin.componentes.tables_objetos_fluxos')
                    @break

                    @case('tarefa')
                    @includeIf('layouts.admin.componentes.tables_tarefas')
                    @break;

                    @case('modelo_diagramatico')
                    @includeIf('layouts.admin.componentes.tables_modelos')
                    @break;
                    @case('projeto')
                    @includeIf('layouts.admin.componentes.tables_projetos')
                    @break;

                    @case('repositorio')
                    @includeIf('layouts.admin.componentes.tables_repositorios')
                    @break;
                    @case('usuario')
                    @includeIf('layouts.admin.componentes.tables_usuarios')
                    @break;
                    @case('repositorio_github')
                    @includeIf('layouts.admin.componentes.tables_repositorios_github')
                    @break;
                    @case('log')
                    @includeIf('layouts.admin.componentes.tables_logs')
                    @break;
                    @case('documentacao')
                    @includeIf('layouts.admin.componentes.tables_documentacoes')
                    @break;
                    @case('regra')
                    @includeIf('layouts.admin.componentes.tables_regras')
                    @break;
                @endswitch
            </table>
        </div>
    </div>
    <div class="card-footer small text-muted"></div>
</div>
