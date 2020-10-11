<?php

namespace Modules\Ecommerce\Http\Controllers\Admin\Categories;

use Modules\Ecommerce\Entities\Categories\Repositories\CategoryRepository;
use Modules\Ecommerce\Entities\Categories\Repositories\Interfaces\CategoryRepositoryInterface;
use Modules\Ecommerce\Entities\Categories\Requests\CreateCategoryRequest;
use Modules\Ecommerce\Entities\Categories\Requests\UpdateCategoryRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryRepo;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->categoryRepo = $categoryRepository;
        // $this->middleware(['permission:categories, guard:employee']);
    }


    public function index()
    {
        $list = $this->categoryRepo->rootCategories();

        return view('ecommerce::admin.categories.list', [
            'categories' => $list
        ]);
    }

    public function create()
    {
        return view('ecommerce::admin.categories.create', [
            'categories' => $this->categoryRepo->listCategories('name', 'asc')
        ]);
    }

    public function store(CreateCategoryRequest $request)
    {
        $this->categoryRepo->createCategory($request->except('_token', '_method'));

        return redirect()->route('admin.categories.index')
            ->with('message', config('messaging.create'));
    }

    public function show($id)
    {
        $category = $this->categoryRepo->findCategoryById($id);

        $cat = new CategoryRepository($category);

        return view('ecommerce::admin.categories.show', [
            'category' => $category,
            'categories' => $category->children,
            'products' => $cat->findProductsOrder()
        ]);
    }

    public function edit($id)
    {
        return view('ecommerce::admin.categories.edit', [
            'categories' => $this->categoryRepo->listCategories('name', 'asc', $id),
            'category' => $this->categoryRepo->findCategoryById($id)
        ]);
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = $this->categoryRepo->findCategoryById($id);

        $update = new CategoryRepository($category);
        $update->updateCategory($request->except('_token', '_method'));

        $request->session()->flash('message', config('messaging.update'));
        return redirect()->route('admin.categories.edit', $id);
    }

    public function destroy(int $id)
    {
        $category = $this->categoryRepo->findCategoryById($id);
        $category->products()->sync([]);
        $category->delete();

        request()->session()->flash('message', config('messaging.delete'));
        return redirect()->route('admin.categories.index');
    }

    public function removeImage(Request $request)
    {
        $this->categoryRepo->deleteFile($request->only('category'));
        request()->session()->flash('message', config('messaging.delete'));
        return redirect()->route('admin.categories.edit', $request->input('category'));
    }

    public function updateSortOrder(Request $request, int $id)
    {
        $data = $request->json();
        foreach ($data as $key => $value) {
            $res = $this->categoryRepo->updateSortOrder($value);
        }
        return $res;
    }
}
