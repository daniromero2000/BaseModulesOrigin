<nav aria-label=" ...">
    <ul class="pagination justify-content-center mb-0 py-2">
        <li class="page-item">
            @php
            $search = request()->input();
            $search['skip'] = ($skip - 1);
            @endphp
            <a class="page-link" href="{{ route("$optionsRoutes.index", $search ) }}" @if ($skip < 1 ) hidden @endif
                tabindex="-1">
                <i class="fas fa-angle-left"></i>
                <span class="sr-only">Previous</span>
            </a>
        </li>
        @php
        $search3 = request()->input();
        $search3['skip'] = 0;
        @endphp
        @if ($max > 11)
        <li class="page-item "><a class="page-link " href="{{ route("$optionsRoutes.index", $search3)  }}">{{1}}</a>
        </li>...
        @endif
        @for ($i; $i < ($max); $i++) @php $search[$i]=request()->input();
            $search[$i]['skip'] = ($skipPaginate = $i);
            @endphp
            <li class="page-item @if(request()->input('skip') == $i) active @endif">
                <a class="page-link " href="{{ route("$optionsRoutes.index", $search[$i])  }}">{{$i + 1}}</a>
            </li>
            @endfor
            @if ($max < $paginate) ... @php $search4=request()->input();
                $search4['skip'] = $paginate;
                @endphp <li class="page-item "><a class="page-link "
                        href="{{ route("$optionsRoutes.index", $search4)  }}">{{$paginate}}</a>
                </li>
                @endif

                @php
                $search2= request()->input();
                $search2['skip'] = ($skip + 1);
                @endphp

                <li class="page-item">
                    <a class="page-link" href="{{ route("$optionsRoutes.index", $search2 ) }}">
                        <i class="fas fa-angle-right"></i>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
    </ul>
</nav>