<?php

namespace Modules\Ecommerce\Http\Controllers\Front;

use Modules\Ecommerce\Entities\Products\Product;
use Modules\Ecommerce\Entities\Products\Repositories\Interfaces\ProductRepositoryInterface;
use App\Http\Controllers\Controller;
use Modules\Ecommerce\Entities\Products\Transformations\ProductTransformable;

class ProductController extends Controller
{
    use ProductTransformable;
    private $productRepo;

    public function __construct(
        ProductRepositoryInterface $productRepository
    ) {
        $this->productRepo = $productRepository;
    }

    public function search()
    {
        if (request()->has('q') && request()->input('q') != '') {
            $list = $this->productRepo->searchProduct(request()->input('q'));
        } else {
            $list = $this->productRepo->listProducts();
        }

        $products = $list->where('status', 1)->map(function (Product $item) {
            return $this->transformProduct($item);
        });

        return view('ecommerce::front.products.product-search', [
            'products' => $products->all()
        ]);
    }

    public function show(string $slug)
    {
        if (request()->has('item')) {
            dd(request()->input());
        }
        $product = $this->productRepo->findProductBySlug(['slug' => $slug]);
        return view('ecommerce::front.products.product', [
            'product' => $product,
            'images' => $product->images()->get(),
            'productAttributes' => $product->attributes,
            'category' => $product->categories()->first()
        ]);
    }

    public function outlet()
    {
        return view('ecommerce::front.products.outlet', [
            'products' => $this->productRepo->listProductGroups('Outlet')
        ]);
    }
}