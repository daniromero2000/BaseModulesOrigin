<div class="container-reset">
    <div class="text-center content-title-banner-products">
        <h4>
            los <img src="{{ asset('img/fvn/plus.jpg') }}" alt=""> vendidos
        </h4>
    </div>
    <div class="p-4">
        <div class="glider-contain">
            <div class="glider">
                @foreach ($products1 as $item)
                <a href="{{ route('front.get.product', str_slug($item->slug)) }}">
                    <div class="card-body p-2">
                        <img src="{{ asset('storage/'.$item->cover) }}" alt="{{ $item->name }}"
                            class="img-card-product">
                    </div>
                </a>
                @endforeach
            </div>
            <button class="glider-prev glider-prev-one"><i class="fas fa-caret-left slider"></i></button>
            <button class="glider-next glider-next-one"><i class="fas fa-caret-right slider"></i></button>
        </div>
    </div>

</div>
{{-- <section class="new-product t100 home">
    <div class="container-reset">
        <div class="section-title b50">
            <h2>{{ $cat1->name }}</h2>
</div>
@include('ecommerce::front.products.product-list', ['products' => $cat1->products->where('status', 1)])
<div id="browse-all-btn"> <a class="btn btn-default browse-all-btn"
        href="{{ route('front.category.slug', $cat1->slug) }}" role="button">browse all items</a></div>
</div>
</section> --}}