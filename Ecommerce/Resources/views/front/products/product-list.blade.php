@if(!empty($products) && !collect($products)->isEmpty())

<div class="row mx-0 text-center">
    @foreach($products as $product)
    <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6 col-xs-12 mb-4">
        <div class="single-product">
            <div class="product">
                @if(isset($product->cover))
                <div class="card border-0 text-center card-products">
                    <div class="height-container-img-product">
                        <img src="{{ asset("storage/$product->cover") }}" class="card-products-img"
                            alt="{{ asset("storage/$product->cover") }}">
                    </div>
                    <div class="card-body pt-3 pb-0 pr-3 pl-3">
                        <p class="title-product">{{$product->name}}</p>
                        <p class="mb-1 price-product">${{ number_format($product->price, 0)}}</p>
                    </div>
                    <div class="row justify-content-center">
                        <a class="text-dark" data-toggle="modal" data-target="#productModal{{ $product->id }}">
                            <div class="icons-options">
                                <i class="fas fa-eye"></i>
                            </div>
                        </a>
                        <a class="text-dark" href="">
                            <div class="icons-options">
                                <i class="fas fa-heart"></i>
                            </div>
                        </a>
                        <a class="text-dark" href="{{ route('front.get.product', str_slug($product->slug)) }}">
                            <div class="icons-options">
                                <i class="fas fa-external-link-square-alt"></i>
                            </div>
                        </a>
                    </div>
                </div>
                @else
                <img src="https://placehold.it/263x330" alt="{{ $product->name }}"
                    class="height-container-img-product" />
                @endif

            </div>
            <div class="modal fade" id="productModal{{ $product->id }}" data-backdrop="static" data-keyboard="false"
                tabindex="-1" role="dialog" aria-labelledby="productModal{{ $product->id }}Label" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-content">
                            <div class="row mx-0 justify-content-end">
                                <button type="button" class="close mr-2 mt-1" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @include('ecommerce::layouts.front.modal-product')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @if($products instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
    <div class="row">
        <div class="col-md-12">
            <div class="pull-left">{{ $products->links() }}</div>
        </div>
    </div>
    @endif
</div>
@else
<p class="alert alert-warning">No hay productos aún</p>
@endif