@if (isset($position))
    <nav aria-label=" ...">
    <ul class="pagination justify-content-center d-flex mb-0 py-2">
        @if ($position > 10)
        @php
        $searchPrev = request()->input();
        $searchPrev['skip'] = $skip - 10 ;
        @endphp
        <li class="page-item "><a class="page-link " href="{{ route("$optionsRoutes", $searchPrev)  }}"><</i> <</i></a>
        </li>
        @endif
        <li class="page-item">
            @php
            $previous = request()->input();
            $previous['skip'] = ($skip - 1);
            @endphp
            <a class="page-link" href="{{ route("$optionsRoutes", $previous ) }}" @if ($skip < 1 ) hidden @endif
                tabindex="-1">
                <</i>
                <span class="sr-only">Previous</span>
            </a>
        </li>
        @php
        $searchReset = request()->input();
        $searchReset['skip'] = 0;
        @endphp

        @if ($limit > 11)
        <li class="page-item "><a class="page-link " href="{{ route("$optionsRoutes", $searchReset)  }}">{{1}}</a>
        </li>...
        @endif
        @for ($position; $position < ($limit); $position++)

            @php $search[$position]=request()->input();
            $search[$position]['skip'] = ($skipPaginate = $position);
            @endphp

            @if ($position >= 0)
            <li class="page-item @if(request()->input('skip') == $position) active @endif">
                <a class="page-link " href="{{ route("$optionsRoutes", $search[$position])  }}">{{$position + 1}}</a>
            </li>
            @endif
            @endfor

            @if ($limit < $paginate) ... @php $searchLast=request()->input();
                $searchLast['skip'] = $paginate - 1;
                @endphp <li class="page-item "><a class="page-link "
                        href="{{ route("$optionsRoutes", $searchLast)  }}">{{$paginate}}</a>
                </li>
                @endif

                @php
                $next = request()->input();
                $next['skip'] = ($skip + 1);
                @endphp

             @if ($next['skip'] < $limit)
                    <li class="page-item">
                    <a class="page-link" href="{{ route("$optionsRoutes", $next ) }}">
                       >
                        <span class="sr-only">Next</span>
                    </a>
                </li>


             @endif
                @if ($paginate > 10 && ($skip + 10) < $paginate) @php $searchNext=request()->input();
                    $searchNext['skip'] = $skip + 10 ;
                    @endphp
                    <li class="page-item "><a class="page-link "
                            href="{{ route("$optionsRoutes", $searchNext)  }}">
                           >></a>
                    </li>
                    @endif
    </ul>
</nav>
@endif
