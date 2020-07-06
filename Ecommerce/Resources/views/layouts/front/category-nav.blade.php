@foreach($categories as $category)
<li class="nav-item">
    @if($category->children()->count() > 0)
    @include('layouts.front.category-sub', ['subs' => $category->children])
    @else
    <a @if(request()->segment(2) == $category->slug) class="active nav-link" @endif class="nav-link"
        href="{{route('front.category.slug', $category->slug)}}">{{$category->name}}</a>
    @endif
</li>
@endforeach