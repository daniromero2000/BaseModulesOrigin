<?php

namespace Modules\Ecommerce\Http\Controllers\Admin\Products;

use Modules\Ecommerce\Entities\Attributes\Repositories\AttributeRepositoryInterface;
use Modules\Ecommerce\Entities\AttributeValues\Repositories\AttributeValueRepositoryInterface;
use Modules\Ecommerce\Entities\Brands\Repositories\Interfaces\BrandRepositoryInterface;
use Modules\Ecommerce\Entities\Categories\Repositories\Interfaces\CategoryRepositoryInterface;
use Modules\Ecommerce\Entities\ProductAttributes\ProductAttribute;
use Modules\Ecommerce\Entities\Products\Product;
use Modules\Ecommerce\Entities\Products\Repositories\Interfaces\ProductRepositoryInterface;
use Modules\Ecommerce\Entities\Products\Repositories\ProductRepository;
use Modules\Ecommerce\Entities\Products\Requests\CreateProductRequest;
use Modules\Ecommerce\Entities\Products\Requests\UpdateProductRequest;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Modules\Ecommerce\Entities\Products\Transformations\ProductTransformable;
use Modules\Generals\Entities\Tools\UploadableTrait;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\Ecommerce\Entities\ProductGroups\Repositories\Interfaces\ProductGroupRepositoryInterface;
use Modules\Ecommerce\Entities\ProductAttributes\Repositories\ProductAttributeRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class ProductController extends Controller
{
    use ProductTransformable, UploadableTrait;
    private $productRepo, $categoryRepo, $attributeRepo, $attributeValueRepository;
    private $productAttribute, $brandRepo, $productGroupInterface, $productAttributeInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        ProductRepositoryInterface $productRepository,
        CategoryRepositoryInterface $categoryRepository,
        AttributeRepositoryInterface $attributeRepository,
        AttributeValueRepositoryInterface $attributeValueRepository,
        ProductAttribute $productAttribute,
        BrandRepositoryInterface $brandRepository,
        ProductGroupRepositoryInterface $productGroupRepositoryInterface,
        ProductAttributeRepositoryInterface $productAttributeRepositoryInterface
    ) {
        $this->toolsInterface           = $toolRepositoryInterface;
        $this->productRepo              = $productRepository;
        $this->categoryRepo             = $categoryRepository;
        $this->attributeRepo            = $attributeRepository;
        $this->attributeValueRepository = $attributeValueRepository;
        $this->productAttribute         = $productAttribute;
        $this->brandRepo                = $brandRepository;
        $this->productGroupInterface    = $productGroupRepositoryInterface;
        $this->productAttributeInterface         = $productAttributeRepositoryInterface;
        $this->middleware(['permission:products, guard:employee']);
    }

    public function index(Request $request)
    {
        if (request()->has('q') && request()->input('q') != '') {
            $skip = 0;
            $list = $this->productRepo->searchProduct(request()->input('q'));
        } else {
            $skip = $this->toolsInterface->getSkip($request->input('skip'));
            $list = $this->productRepo->listProducts($skip * 30);
        }

        $products = $list->map(function (Product $item) {
            return $this->transformProduct($item);
        })->all();
        return view('ecommerce::admin.products.list', [
            'products'       => $products,
            'optionsRoutes'  => 'admin.' . (request()->segment(2)),
            'skip'           => $skip
        ]);
    }

    public function create()
    {
        return view('ecommerce::admin.products.create', [
            'categories'     => $this->categoryRepo->listCategories('name', 'asc'),
            'brands'         => $this->brandRepo->listBrands(['*'], 'name', 'asc'),
            'default_weight' => env('SHOP_WEIGHT'),
            'weight_units'   => Product::MASS_UNIT,
            'product'        => new Product
        ]);
    }

    public function store(CreateProductRequest $request)
    {
        $data = $request->except('_token', '_method');
        $data['slug'] = str_slug($request->input('name'));
        $data['company_id'] = auth()->guard('employee')->user()->company_id;
        $data['tax_id'] = 1;

        if ($request->hasFile('cover') && $request->file('cover') instanceof UploadedFile) {
            $data['cover'] = $this->productRepo->saveCoverImage($request->file('cover'));
        }
        $data['company_id'] = 1;

        $product = $this->productRepo->createProduct($data);
        $productRepo = new ProductRepository($product);

        if ($request->hasFile('image')) {
            $productRepo->saveProductImages(collect($request->file('image')));
        }

        if ($request->has('categories')) {
            $productRepo->syncCategories($request->input('categories'));
        } else {
            $productRepo->detachCategories();
        }

        return redirect()->route('admin.products.edit', $product->id)
            ->with('message', config('messaging.create'));
    }

    public function show(int $id)
    {
        return view('ecommerce::admin.products.show', [
            'product' =>  $this->productRepo->findProductById($id)
        ]);
    }

    public function edit(int $id)
    {
        $product = $this->productRepo->findProductById($id);

        $productAttributes = $product->attributes()->get();

        $qty = $productAttributes->map(function ($item) {
            return $item->quantity;
        })->sum();

        if (request()->has('delete') && request()->has('pa')) {
            // dd(request()->input('pa'));

            $pa = $productAttributes->where('id', request()->input('pa'))->first();
            // dd($pa);
            $pa->attributesValues()->detach();
            $pa->delete();

            request()->session()->flash('message', 'Delete successful');
            return redirect()->route('admin.products.edit', [$product->id]);
        }

        return view('ecommerce::admin.products.edit', [
            'product' => $product,
            'images' => $product->images()->get(['src']),
            'categories' => $this->categoryRepo->listCategories('name', 'asc')->toTree(),
            'product_groups' => $this->productGroupInterface->listproductGroups(),
            'selectedIds' => $product->categories()->pluck('category_id')->all(),
            'selectedGroupIds' => $product->productGroups()->pluck('product_group_id')->all(),
            'attributes' => $this->attributeRepo->listAttributes(),
            'productAttributes' => $productAttributes,
            'qty' => $qty,
            'brands' => $this->brandRepo->listBrands(['*'], 'name', 'asc'),
            'weight' => $product->weight,
            'default_weight' => $product->mass_unit,
            'weight_units' => Product::MASS_UNIT
        ]);
    }

    public function update(Request $request, int $id)
    {
        $product = $this->productRepo->findProductById($id);
        $productRepo = new ProductRepository($product);

        if ($request->has('attributeValue')) {
            $this->saveProductCombinations($request, $product);
            return redirect()->route('admin.products.edit', [$id])
                ->with('message', config('messaging.create'));
        }

        if ($request->has('attributeId')) {
            $this->updateProductCombinations($request, $product);
            return redirect()->route('admin.products.edit', [$id])
                ->with('message', config('messaging.update'));
        }

        $data = $request->except(
            'categories',
            'product_groups',
            '_token',
            '_method',
            'default',
            'image',
            'productAttributeQuantity',
            'productAttributePrice',
            'attributeValue',
            'combination',
            'pAQuantity',
            'pAPrice',
            'pASalePrice',
            'attributeId',
            'attribute',
            'salePrice'
        );

        $data['slug'] = str_slug($request->input('name'));

        if ($request->hasFile('cover')) {
            $data['cover'] = $productRepo->saveCoverImage($request->file('cover'));
        }

        if ($request->hasFile('image')) {
            $productRepo->saveProductImages(collect($request->file('image')));
        }

        if ($request->has('categories')) {

            $productRepo->syncCategories($request->input('categories'));
        } else {

            $productRepo->detachCategories();
        }

        if ($request->has('product_groups')) {
            $productRepo->syncProducGroups($request->input('product_groups'));
        } else {
            $productRepo->detachProductGroup();
        }

        $productRepo->updateProduct($data);

        return redirect()->route('admin.products.edit', $id)
            ->with('message', config('messaging.update'));
    }

    public function destroy($id)
    {
        $product = $this->productRepo->findProductById($id);
        $product->categories()->sync([]);
        $productAttr = $product->attributes();

        $productAttr->each(function ($pa) {
            DB::table('attribute_value_product_attribute')->where('product_attribute_id', $pa->id)->delete();
        });

        $productAttr->where('product_id', $product->id)->delete();

        $productRepo = new ProductRepository($product);
        $productRepo->removeProduct();

        return redirect()->route('admin.products.index')
            ->with('message', config('messaging.delete'));
    }

    public function removeImage(Request $request)
    {
        $this->productRepo->deleteFile($request->only('product', 'image'), 'uploads');
        return redirect()->back()->with('message', config('messaging.delete'));
    }

    public function removeThumbnail(Request $request)
    {
        $this->productRepo->deleteThumb($request->input('src'));
        return redirect()->back()->with('message', config('messaging.delete'));
    }

    private function saveProductCombinations(Request $request, Product $product): bool
    {
        $fields = $request->only(
            'productAttributeQuantity',
            'productAttributePrice',
            'default'
        );
        $fields += ['sale_price'  => $request['salePrice']];

        if ($errors = $this->validateFields($fields)) {
            return redirect()->route('admin.products.edit', [$product->id])
                ->withErrors($errors);
        }

        $quantity = $fields['productAttributeQuantity'];
        $price = $fields['productAttributePrice'];

        $sale_price = null;
        if (isset($fields['sale_price'])) {
            $sale_price = $fields['sale_price'];
        }

        $attributeValues = $request->input('attributeValue');
        $productRepo = new ProductRepository($product);

        $hasDefault = $productRepo->listProductAttributes()->where('default', 1)->count();

        $default = 0;
        if ($request->has('default')) {
            $default = $fields['default'];
        }

        if ($default == 1 && $hasDefault > 0) {
            $default = 0;
        }

        $productAttribute = $productRepo->saveProductAttributes(
            new ProductAttribute(compact('quantity', 'price', 'sale_price', 'default'))
        );

        if ($request->hasFile('image')) {
            $productRepo->saveAttributeProductImages(collect($request->file('image')), $productAttribute->id);
        }

        // save the combinations
        return collect($attributeValues)->each(function ($attributeValueId) use ($productRepo, $productAttribute) {
            $attribute = $this->attributeValueRepository->find($attributeValueId);
            return $productRepo->saveCombination($productAttribute, $attribute);
        })->count();
    }


    private function updateProductCombinations(Request $request, Product $product): bool
    {

        $fields = $request->only(
            'pAQuantity',
            'pAPrice',
            'pASalePrice',
            'attributeId',
            'pAattribute',
            'pAattributeValue'
        );


        $productAttribute = $this->productAttributeInterface->findProductAttributeById($fields['attributeId']);

        if ($request->has('pAattribute')) {
            $attributeValues = $fields['pAattributeValue'];
            $productAttribute->attributesValues()->detach();
            collect($attributeValues)->each(function ($attributeValueId) use ($productAttribute) {
                $attribute = $this->attributeValueRepository->find($attributeValueId);
                return $this->productRepo->saveCombination($productAttribute, $attribute);
            })->count();
        }

        if ($errors = $this->validateUpdateFields($fields)) {
            return redirect()->route('admin.products.edit', [$product->id])
                ->withErrors($errors);
        }

        $productAttribute->quantity = $fields['pAQuantity'];
        $productAttribute->price = $fields['pAPrice'];
        $productAttribute->sale_price = $fields['pASalePrice'];

        try {
            $productAttribute->update();
        } catch (QueryException $th) {
            dd($th);
        }

        return  true;
    }

    private function validateUpdateFields(array $data)
    {
        $validator = Validator::make($data, [
            'pAQuantity' => 'required'
        ]);

        if ($validator->fails()) {
            return $validator;
        }
    }

    private function validateFields(array $data)
    {
        $validator = Validator::make($data, [
            'productAttributeQuantity' => 'required'
        ]);

        if ($validator->fails()) {
            return $validator;
        }
    }

    public function duplicateProduct(Request $request)
    {
        $newProduct = $this->productRepo->duplicateProduct($request->input('id'));

        return redirect()->route('admin.products.edit', [$newProduct->id])
            ->with('message', 'Producto Clonado Exitosamente');
    }

    public function updateSortOrder(Request $request, int $id)
    {
        $data = $request->json();
        foreach ($data as $key => $value) {
            $res = $this->productRepo->updateSortOrder($value);
        }
        return $res;
    }
}
