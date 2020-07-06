<div class="category-top col-md-12">
    <h2>{{ $category->name }}</h2>
    <hr>
</div>
<form action="{{route('front.category.slug',$category->slug)}}" method="get">
    @foreach($atributes as $atribute)
    <div class="accordion" id="accordionExample{{$atribute->id}}">
        <h2 class="mb-0">
            <button
                class="btn btn-link btn-block text-left accordionBtn @if(request()->input('q')) show @else collapsed  @endif"
                type="button" data-toggle="collapse" data-target="#collapseOne{{ $atribute->id}}" aria-expanded="true"
                aria-controls="collapseOne{{ $atribute->id}}">
                {{$atribute->name}}
            </button>
        </h2>
        <div id="collapseOne{{ $atribute->id}}" class="collapse @if(request()->input('q')) ? show : @endif "
            aria-labelledby="headingOne" data-parent="#accordionExample{{$atribute->id}}">
            <ul>
                @if ($atribute->attributeValue)
                @foreach ($atribute->attributeValue as $item)
                <li>
                    <label class="">
                        <input type="checkbox" value="{{$item->value}}" @if( request()->input('q') &&
                        in_array($item->value, request()->input('q'))) checked="checked" @endif
                        name="q[]">
                        {{$item->value}}
                    </label>
                </li>
                @endforeach
                @endif
            </ul>
        </div>
    </div>
    @endforeach
    <button class="btn btn-primary my-4">Buscar</button>
</form>