@if ($paginator->lastPage() > 1)
<div class="pagination-area mb-20">
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-start">
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->url(1) }}"><i class="fi-rs-arrow-small-left"></i></a>
            </li>
            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <li class="page-item {{ ($paginator->currentPage() == $i) ? ' active' : '' }}"><a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
            @endfor
                <li class="page-item">
                <a class="page-link" href="{{ $paginator->url($paginator->currentPage()+1) }}"><i class="fi-rs-arrow-small-right"></i></a>
            </li>
        </ul>
    </nav>
</div>
@endif

