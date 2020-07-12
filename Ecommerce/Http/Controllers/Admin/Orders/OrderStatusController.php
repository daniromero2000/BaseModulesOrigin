<?php

namespace Modules\Ecommerce\Http\Controllers\Admin\Orders;

use Modules\Ecommerce\Entities\OrderStatuses\Repositories\Interfaces\OrderStatusRepositoryInterface;
use Modules\Ecommerce\Entities\OrderStatuses\Repositories\OrderStatusRepository;
use Modules\Ecommerce\Entities\OrderStatuses\Requests\CreateOrderStatusRequest;
use Modules\Ecommerce\Entities\OrderStatuses\Requests\UpdateOrderStatusRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderStatusController extends Controller
{
    private $orderStatuses;

    public function __construct(OrderStatusRepositoryInterface $orderStatusRepository)
    {
        $this->orderStatuses = $orderStatusRepository;
        $this->middleware(['permission:orders, guard:employee']);
    }

    public function index()
    {
        return view('ecommerce::admin.order-statuses.list', [
            'orderStatuses' => $this->orderStatuses->listOrderStatuses()
        ]);
    }

    public function create()
    {
        return view('ecommerce::admin.order-statuses.create');
    }

    public function store(CreateOrderStatusRequest $request)
    {
        $this->orderStatuses->createOrderStatus($request->except('_token', '_method'));
        $request->session()->flash('message', config('messaging.create'));
        return redirect()->route('admin.order-statuses.index');
    }

    public function edit(int $id)
    {
        return view('ecommerce::admin.order-statuses.edit', [
            'orderStatus' => $this->orderStatuses->findOrderStatusById($id)
        ]);
    }

    public function update(UpdateOrderStatusRequest $request, int $id)
    {
        $orderStatus = $this->orderStatuses->findOrderStatusById($id);

        $update = new OrderStatusRepository($orderStatus);
        $update->updateOrderStatus($request->all());

        $request->session()->flash('message', config('messaging.update'));
        return redirect()->route('admin.order-statuses.edit', $id);
    }

    public function destroy(int $id)
    {
        $this->orderStatuses->findOrderStatusById($id)->delete();

        request()->session()->flash('message', config('messaging.delete'));
        return redirect()->route('admin.order-statuses.index');
    }
}
