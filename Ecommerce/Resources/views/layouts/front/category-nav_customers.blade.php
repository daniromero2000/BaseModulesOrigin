@foreach($categories as $category)
<li aria-haspopup="true"><span class="wsmenu-click"><i class="wsmenu-arrow"></i></span><a href="#"
        class="navtext"><span>{{$category->name}}</span></a>
    <div class="wsmegamenu clearfix">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    <ul class="wstliststy02 clearfix">
                        @foreach ($category->children as $children)
                        <li class="wstheading clearfix"> {{$children->name}} </li>
                        @foreach ($children->children as $newChildren)
                        <li><a href="#">{{$newChildren->name}} </a> </li>
                        {{-- <span class="wstmenutag redtag">Popular</span> --}}
                        @endforeach
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</li>
@endforeach