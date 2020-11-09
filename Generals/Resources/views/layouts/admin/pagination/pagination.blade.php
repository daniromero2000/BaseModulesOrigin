<nav aria-label=" ...">
    <ul class="pagination justify-content-center mb-0 py-2">
        @if ($i > 10)
        @php
        $searchPrev = request()->input();
        $searchPrev['skip'] = $skip - 10 ;
        @endphp
        <li class="page-item "><a class="page-link " href="{{ route("$optionsRoutes.index", $searchPrev)  }}"><i
                    class="fas fa-angle-left"></i> <i class="fas fa-angle-left"></i></a>
        </li>
        @endif
        <li class="page-item">
            @php
            $previous = request()->input();
            $previous['skip'] = ($skip - 1);
            @endphp
            <a class="page-link" href="{{ route("$optionsRoutes.index", $previous ) }}" @if ($skip < 1 ) hidden @endif
                tabindex="-1">
                <i class="fas fa-angle-left"></i>
                <span class="sr-only">Previous</span>
            </a>
        </li>
        @php
        $searchReset = request()->input();
        $searchReset['skip'] = 0;
        @endphp

        @if ($max > 11)
        <li class="page-item "><a class="page-link " href="{{ route("$optionsRoutes.index", $searchReset)  }}">{{1}}</a>
        </li>...
        @endif
        @for ($i; $i < ($max); $i++) <div>
            </div>

            @php $search[$i]=request()->input();
            $search[$i]['skip'] = ($skipPaginate = $i);
            @endphp

            @if ($i >= 0)
            <li class="page-item @if(request()->input('skip') == $i) active @endif">
                <a class="page-link " href="{{ route("$optionsRoutes.index", $search[$i])  }}">{{$i + 1}}</a>
            </li>
            @endif
            @endfor

            @if ($max < $paginate) ... @php $searchLast=request()->input();
                $searchLast['skip'] = $paginate - 1;
                @endphp <li class="page-item "><a class="page-link "
                        href="{{ route("$optionsRoutes.index", $searchLast)  }}">{{$paginate}}</a>
                </li>
                @endif

                @php
                $next= request()->input();
                $next['skip'] = ($skip + 1);
                @endphp

                <li class="page-item">
                    <a class="page-link" href="{{ route("$optionsRoutes.index", $next ) }}">
                        <i class="fas fa-angle-right"></i>
                        <span class="sr-only">Next</span>
                    </a>
                </li>


                @if ($paginate > 10 && ($skip + 10) < $paginate) @php $searchNext=request()->input();
                    $searchNext['skip'] = $skip + 10 ;
                    @endphp
                    <li class="page-item "><a class="page-link "
                            href="{{ route("$optionsRoutes.index", $searchNext)  }}">
                            <i class="fas fa-angle-right"></i> <i class="fas fa-angle-right"></i></a>
                    </li>
                    @endif
    </ul>
</nav>