<?php

namespace Modules\Ecommerce\Http\Controllers\Admin\Brands;

use App\Http\Controllers\Controller;
use Modules\Ecommerce\Entities\Brands\Repositories\BrandRepository;
use Modules\Ecommerce\Entities\Brands\Repositories\Interfaces\BrandRepositoryInterface;
use Modules\Ecommerce\Entities\Brands\Requests\CreateBrandRequest;
use Modules\Ecommerce\Entities\Brands\Requests\UpdateBrandRequest;

class BrandController extends Controller
{
    private $brandRepo;

    public function __construct(BrandRepositoryInterface $brandRepository)
    {
        $this->brandRepo = $brandRepository;
        $this->middleware(['permission:brands, guard:employee']);
    }

    public function index()
    {
        return view('ecommerce::admin.brands.list', [
            'brands' => $this->brandRepo->listBrands(['*'], 'name', 'asc')->all()
        ]);
    }

    public function create()
    {
        return view('ecommerce::admin.brands.create');
    }

    public function store(CreateBrandRequest $request)
    {
        $this->brandRepo->createBrand($request->all());

        return redirect()->route('admin.brands.index')
            ->with('message', config('messaging.create'));
    }

    public function edit($id)
    {
        return view('ecommerce::admin.brands.edit', [
            'brand' => $this->brandRepo->findBrandById($id)
        ]);
    }

    public function update(UpdateBrandRequest $request, $id)
    {
        $brand = $this->brandRepo->findBrandById($id);
        $brandRepo = new BrandRepository($brand);
        $brandRepo->updateBrand($request->all());

        return redirect()->route('admin.brands.edit', $id)
            ->with('message', config('messaging.update'));
    }

    public function destroy($id)
    {
        $brand = $this->brandRepo->findBrandById($id);

        $brandRepo = new BrandRepository($brand);
        $brandRepo->dissociateProducts();
        $brandRepo->deleteBrand();

        return redirect()->route('admin.brands.index')
            ->with('message', config('messaging.delete'));
    }
}
