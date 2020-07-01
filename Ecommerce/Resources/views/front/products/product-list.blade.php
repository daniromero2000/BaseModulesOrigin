@if(!empty($products) && !collect($products)->isEmpty())

<div class="row mx-0 text-center">
    @foreach($products as $product)
    <div class="col-md-4 col-sm-6 col-xs-12 mb-4">
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
                        <p class="mb-1 price-product">${{ number_format($product->price, 2)}}</p>
                    </div>
                    <div class="row justify-content-center">
                        <form action="{{ route('cart.store') }}" class="form-inline" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="quantity" value="1" />
                            <input type="hidden" name="product" value="{{ $product->id }}">
                            <button class="text-dark btn-reset" id="add-to-cart-btn" type="submit">
                                <div class="icons-options">
                                    <i class="fas fa-shopping-cart"></i>

                                </div>
                            </button>
                        </form>
                        <a class="text-dark" data-toggle="modal" data-target="#productModal_{{ $product->id }}">
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
            <div class="modal fade" id="productModal_{{ $product->id }}" data-backdrop="static" data-keyboard="false"
                tabindex="-1" role="dialog" aria-labelledby="productModal_{{ $product->id }}Label" aria-hidden="true">
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