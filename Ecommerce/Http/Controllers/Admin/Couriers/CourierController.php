<?php

namespace Modules\Ecommerce\Http\Controllers\Admin\Couriers;

use Modules\Ecommerce\Entities\Couriers\Repositories\CourierRepository;
use Modules\Ecommerce\Entities\Couriers\Repositories\Interfaces\CourierRepositoryInterface;
use Modules\Ecommerce\Entities\Couriers\Requests\CreateCourierRequest;
use Modules\Ecommerce\Entities\Couriers\Requests\UpdateCourierRequest;
use App\Http\Controllers\Controller;

class CourierController extends Controller
{
    private $courierRepo;

    public function __construct(CourierRepositoryInterface $courierRepository)
    {
        $this->courierRepo = $courierRepository;
        $this->middleware(['permission:couriers, guard:employee']);
    }

    public function index()
    {
        return view('ecommerce::admin.couriers.list', [
            'couriers' => $this->courierRepo->listCouriers('name', 'asc')
        ]);
    }

    public function create()
    {
        return view('ecommerce::admin.couriers.create');
    }

    public function store(CreateCourierRequest $request)
    {
        $this->courierRepo->createCourier($request->all());

        $request->session()->flash('message', config('messaging.create'));
        return redirect()->route('admin.couriers.index');
    }

    public function edit(int $id)
    {
        return view('ecommerce::admin.couriers.edit', [
            'courier' => $this->courierRepo->findCourierById($id)
        ]);
    }

    public function update(UpdateCourierRequest $request, $id)
    {
        $courier = $this->courierRepo->findCourierById($id);

        $update = new CourierRepository($courier);
        $update->updateCourier($request->all());

        $request->session()->flash('message', config('messaging.update'));
        return redirect()->route('admin.couriers.edit', $id);
    }

    public function destroy(int $id)
    {
        $courier = $this->courierRepo->findCourierById($id);

        $courierRepo = new CourierRepository($courier);
        $courierRepo->delete();

        request()->session()->flash('message', config('messaging.delete'));
        return redirect()->route('admin.couriers.index');
    }
}
