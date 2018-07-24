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
                    @includeIf('layouts.layout_admin_new.componentes.tables_titulos')
                </tr>
                </thead>

                <tfoot>
                @includeIf('layouts.layout_admin_new.componentes.tables_titulos')
                </tfoot>
                @switch($tipo)
                    @case('regra')
                    @includeIf('layouts.layout_admin_new.componentes.tables_regras')
                    @break

                    @case('tarefa')
                    @includeIf('layouts.layout_admin_new.componentes.tables_tarefas')
                    @break;

                    @case('modelo')
                    @includeIf('layouts.layout_admin_new.componentes.tables_modelos')
                    @break;

                    @case('projeto')
                    @includeIf('layouts.layout_admin_new.componentes.tables_projetos')
                    @break;

                    @case('organizacao')
                    @includeIf('layouts.layout_admin_new.componentes.tables_organizacoes')
                    @break;
                    @case('usuario')
                    @includeIf('layouts.layout_admin_new.componentes.tables_usuarios')
                    @break;
                    @case('repositorio')
                    @includeIf('layouts.layout_admin_new.componentes.tables_repositorios')
                    @break;
                @endswitch
            </table>
        </div>
    </div>
    <div class="card-footer small text-muted">Teste</div>
</div>
