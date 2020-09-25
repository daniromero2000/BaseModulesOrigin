<nav aria-label=" ...">
    <ul class="pagination justify-content-end mb-0">
        <li class="page-item ">
            <a class="page-link" href="{{ route("$optionsRoutes.index", ['skip' => ($skip - 1)] ) }}" @if ($skip<1 )
                hidden @endif tabindex="-1">
                <i class="fas fa-angle-left"></i>
                <span class="sr-only">Previous</span>
            </a>
        </li>
        <li class="page-item">
            <a class="page-link" href="{{ route("$optionsRoutes.index", ['skip' => ($skip + 1)] ) }}">
                <i class="fas fa-angle-right"></i>
                <span class="sr-only">Next</span>
            </a>
        </li>
    </ul>
</nav>