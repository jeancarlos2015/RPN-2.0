@if(!empty($titulo) && !empty($sub_titulo))
    <ol class="breadcrumb">


        <li class="breadcrumb-item">
            <a @if(!empty($rota)) href="{!! route($rota) !!}" @endif>{!! $titulo !!}</a>
        </li>
        @if(!empty($branch_atual))
            <li class="breadcrumb-item">{!! $sub_titulo !!}</li>
            <li class="breadcrumb-item active"> Branch Atual / {!! $branch_atual !!}</li>
        @else
            <li class="breadcrumb-item active">{!! $sub_titulo !!}</li>
        @endif
        <li class="afasta">
            <a
                    href="{{ URL::previous() }}"
                    class="btn btn-secondary btn-circle"><i class="fa fa-mail-reply"></i>
            </a>
            <a
                    href="{{ URL::previous() }}">
                <small class="m-l-5">Voltar</small>
            </a>
        </li>
    </ol>

@endif

@section('codigo_css')
<style>
   .afasta{
        margin-left: 80%;
    }
</style>
@endsection