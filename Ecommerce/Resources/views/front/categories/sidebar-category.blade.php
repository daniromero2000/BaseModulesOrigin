{{-- <div class="category-top col-md-12">
    <h2>{{ $category->name }}</h2>
    <hr>
</div> --}}
<div>
    <ul class="category-items">
        <div class="my-3">
            <li>
                <span>VIBRADORES</span>
            </li>
        </div>
        <div class="my-3">
            <li>
                <span>MASCULINOS</span>
            </li>
        </div>
        <div class="my-3">
            <li>
                <span>FEMENINOS</span>
            </li>
        </div>
        <div class="my-3">
            <li>
                <span>JUEGO ANAL</span>
            </li>
        </div>
        <div class="my-3">
            <li>
                <span>CONSOLADORES</span>
            </li>
        </div>
        <div class="my-3">
            <li>
                <span>ARNÉS</span>
            </li>
        </div>
        <div class="my-3">
            <li>
                <span>FIESTAS ERÓTICAS</span>
            </li>
        </div>
        <div class="my-3">
            <li>
                <span>WEBCAMS</span>
            </li>
        </div>
        <div class="my-3">
            <li>
                <span>LIMPIEZA DE JUGUETES</span>
            </li>
        </div>
    </ul>
</div>
<form action="{{route('front.category.slug',$category->slug)}}" class="px-2" method="get">
    @foreach($attributes as $attribute)
    <div class="accordion card mt-1 card-reset" id="accordionExample{{$attribute->id}}">
        <h2 class="mb-0">
            <button class="btn btn-block text-left accordionBtn @if(request()->input('q')) show @else collapsed  @endif"
                type="button" data-toggle="collapse" data-target="#collapseOne{{ $attribute->id}}" aria-expanded="true"
                aria-controls="collapseOne{{ $attribute->id}}">
                {{$attribute->name}}
            </button>
        </h2>
        <div id="collapseOne{{ $attribute->id}}" class="collapse @if(request()->input('q')) ? show : @endif "
            aria-labelledby="headingOne" data-parent="#accordionExample{{$attribute->id}}">
            <ul class="mt-2 scroll-options">
                @if ($attribute->values)
                @foreach ($attribute->values as $item)
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
    <div class="ml-2">
        <button class="btn btn-tws my-4">Buscar</button>
        @if (request()->input('q'))
        <a href="{{route('front.category.slug',$category->slug)}}" class="btn btn-secondary my-4">Restaurar</a>
        @endif
    </div>


</form>
