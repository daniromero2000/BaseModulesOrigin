<?php

namespace Modules\Ecommerce\Http\Controllers\Front;

use Modules\Ecommerce\Entities\Products\Repositories\Interfaces\ProductRepositoryInterface;
use Modules\Ecommerce\Entities\Products\Transformations\ProductTransformable;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\Ecommerce\Entities\Products\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ProductTransformable;
    private $productRepo;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        ProductRepositoryInterface $productRepository
    ) {
        $this->toolsInterface = $toolRepositoryInterface;
        $this->productRepo = $productRepository;
    }

    public function search(Request $request)
    {
        if (request()->has('q') && request()->input('q') != '') {
            $list = $this->productRepo->searchProduct(request()->input('q'));
        } else {
            $skip = $this->toolsInterface->getSkip($request->input('skip'));
            $list = $this->productRepo->listProducts($skip * 30);
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
            'bestSellers' => $this->productRepo->listProductGroups('Nuevos'),
            'productAttributes' => $product->attributes,
            'category' => $product->categories()->first()
        ]);
    }

    public function outlet()
    {
        return view('ecommerce::front.products.outlet', [
            'products' => $this->productRepo->listProductGroups('Outlet'),
            'bestSellers' => $this->productRepo->listProductGroups('Nuevos')
        ]);
    }
}