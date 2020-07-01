<?php

namespace Modules\Ecommerce\Http\Controllers\Front;

use Modules\Ecommerce\Entities\Categories\Repositories\Interfaces\CategoryRepositoryInterface;

class HomeController
{
    private $categoryRepo;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->categoryRepo = $categoryRepository;
    }

    public function index()
    {
        $cat1 = $this->categoryRepo->findCategoryById(2);
        $cat2 = $this->categoryRepo->findCategoryById(3);
        if ($cat1->products->isNotEmpty()) {
            $products1 = $cat1->products->where('is_active', 1);
        }
        return view('ecommerce::front.index', compact('products1', 'cat2'));
    }
}