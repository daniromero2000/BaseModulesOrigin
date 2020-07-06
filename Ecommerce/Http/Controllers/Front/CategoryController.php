<?php

namespace Modules\Ecommerce\Http\Controllers\Front;

use Modules\Ecommerce\Entities\Categories\Repositories\CategoryRepository;
use Modules\Ecommerce\Entities\Categories\Repositories\Interfaces\CategoryRepositoryInterface;
use Modules\Ecommerce\Entities\Attributes\Repositories\AttributeRepositoryInterface;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    private $categoryInterface, $attributeInterface;

    public function __construct(
        CategoryRepositoryInterface $categoryRepositoryInterface,
        AttributeRepositoryInterface $attributeRepositoryInterface
    ) {
        $this->categoryInterface  = $categoryRepositoryInterface;
        $this->attributeInterface = $attributeRepositoryInterface;
    }

    public function getCategory(string $slug)
    {
        $category = $this->categoryInterface->findCategoryBySlug(['slug' => $slug]);
        $CategoryRepository = new CategoryRepository($category);

        if (request('q')) {
            $data = request()->input();
            foreach ($data as $key => $value) {
                foreach ($data[$key] as $key2 => $value2) {
                    $select[] = $data[$key][$key2];
                }
            }
            $products = $CategoryRepository->findProductsFilter($select)->where('is_active', 1);
        } else {
            $products = $CategoryRepository->findProducts()->where('is_active', 1)->all();
        }

        return view('ecommerce::front.categories.category', [
            'category'  => $category,
            'products'  => $products,
            'atributes' => $this->attributeInterface->listAttributes()
        ]);
    }
}
