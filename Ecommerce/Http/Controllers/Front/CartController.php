<?php

namespace Modules\Ecommerce\Http\Controllers\Front;

use Modules\Ecommerce\Entities\Carts\Requests\AddToCartRequest;
use Modules\Ecommerce\Entities\Carts\Requests\UpdateCartRequest;
use Modules\Ecommerce\Entities\Carts\Repositories\Interfaces\CartRepositoryInterface;
use Modules\Ecommerce\Entities\Couriers\Repositories\Interfaces\CourierRepositoryInterface;
use Modules\Ecommerce\Entities\ProductAttributes\Repositories\ProductAttributeRepositoryInterface;
use Modules\Ecommerce\Entities\Products\Product;
use Modules\Ecommerce\Entities\Products\Repositories\Interfaces\ProductRepositoryInterface;
use Modules\Ecommerce\Entities\Products\Repositories\ProductRepository;
use Modules\Ecommerce\Entities\Products\Transformations\ProductTransformable;
use Modules\Ecommerce\Entities\Shoppingcart\CartItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    use ProductTransformable;
    private $cartRepo, $productRepo, $courierRepo, $productAttributeRepo;

    public function __construct(
        CartRepositoryInterface $cartRepository,
        ProductRepositoryInterface $productRepository,
        CourierRepositoryInterface $courierRepository,
        ProductAttributeRepositoryInterface $productAttributeRepository
    ) {
        $this->cartRepo             = $cartRepository;
        $this->productRepo          = $productRepository;
        $this->courierRepo          = $courierRepository;
        $this->productAttributeRepo = $productAttributeRepository;
    }

    public function index()
    {
        $courier = $this->courierRepo->findCourierById(request()->session()->get('courierId', 1));
        $shippingFee = $this->cartRepo->getShippingFee($courier);

        return view('ecommerce::front.carts.cart', [
            'cartItems' => $this->cartRepo->getCartItemsTransformed(),
            'subtotal' => $this->cartRepo->getSubTotal(),
            'tax' => $this->cartRepo->getTax(),
            'shippingFee' => $shippingFee,
            'total' => $this->cartRepo->getTotal(2, $shippingFee)
        ]);
    }

    public function store(AddToCartRequest $request)
    {
        $product = $this->productRepo->findProductById($request->input('product'));

        if ($product->attributes()->count() > 0) {
            $productAttr = $product->attributes()->where('default', 1)->first();

            if (isset($productAttr->sale_price)) {
                $product->price = $productAttr->price;

                if (!is_null($productAttr->sale_price)) {
                    $product->price = $productAttr->sale_price;
                }
            }
        }

        $options = [];
        if ($request->has('productAttribute')) {

            $attr = $this->productAttributeRepo->findProductAttributeById($request->input('productAttribute'));
            $product->price = $attr->price;

            $options['product_attribute_id'] = $request->input('productAttribute');
            $options['combination'] = $attr->attributesValues->toArray();
        }

        $this->cartRepo->addToCart($product, $request->input('quantity'), $options);

        return redirect()->route('cart.index')
            ->with('message', config('messaging.addCart'));
    }

    public function update(UpdateCartRequest $request, $id)
    {
        $this->cartRepo->updateQuantityInCart($id, $request->input('quantity'));

        request()->session()->flash('message', config('messaging.update'));
        return redirect()->route('cart.index');
    }

    public function destroy($id)
    {
        $this->cartRepo->removeToCart($id);

        request()->session()->flash('message', config('messaging.delete'));
        return redirect()->route('cart.index');
    }
}
