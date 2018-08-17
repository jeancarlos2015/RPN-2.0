<li class="nav-item">
    @if(!empty($link))
        <a class="nav-link"
           href="{!! $link !!}">
            <p class="{!! $ico !!}"> {!! $nome !!} </p>
            <span class="sr-only"></span>
        </a>
    @else
        <a class="nav-link">
            <p class="{!! $ico !!}"> {!! $nome !!} </p>
            <span class="sr-only"></span>
        </a>
    @endif
</li>