@if(!empty($titulo))
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a @if(!empty($rota)) href="{!! route($rota) !!}" @endif>{!! $titulo !!}</a>
        </li>
        <li class="breadcrumb-item active">{!! $titulo !!}</li>
    </ol>

@endif