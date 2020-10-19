@foreach($categories as $category)
<li aria-haspopup="true"><span class="wsmenu-click">@if (!empty($category->children->toArray()))<i
            class="wsmenu-arrow"></i>@endif<i class="wsmenu-arrow "></i></span><a
        href="{{route('front.category.slug', $category->slug)}}" class="navtext"><span>{{$category->name}} <br>
            <small>{{$category->name}}</small></span>
        @if (!empty($category->children->toArray()))
        <ul class="sub-menu">
            @foreach ($category->children as $children)
            <li aria-haspopup="true" class="d-flex"><i class="fas fa-angle-right"></i> <a
                    href="{{route('front.category.slug', $children->slug)}}">{{$children->name}}</a> </li>
            @foreach ($children->children as $newChildren)
            <li aria-haspopup="true"> <i class="fas fa-angle-right"></i><a
                    href="{{route('front.category.slug', $newChildren->slug)}}">{{$newChildren->name}} </a>
            </li>
            @endforeach
            @endforeach

        </ul>
        @endif
</li>
@endforeach