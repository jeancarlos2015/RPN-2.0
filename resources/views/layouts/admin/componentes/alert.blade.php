@if(!empty($log))
    <a class="dropdown-item" href="#">
                          <span class="text-success">
                            <strong>
                              <i class="fa fa-long-arrow-up fa-fw"></i>Status De Atualização</strong>
                          </span>
        <span class="small float-right text-muted">{!! $log->descricao !!}</span>
        <div class="dropdown-message small">
            {!! $log->nome !!}
        </div>
    </a>

    <div class="dropdown-divider"></div>

@endif