<?php

namespace Modules\Ecommerce\Http\Controllers\Admin\OrderCommentaries;

use Modules\Ecommerce\Entities\OrderCommentaries\Repositories\Interfaces\OrderCommentaryRepositoryInterface;
use Modules\Ecommerce\Entities\OrderCommentaries\Requests\CreateOrderCommentaryRequest;
use Modules\Ecommerce\Entities\OrderStatusesLogs\Repositories\Interfaces\OrderStatusesLogRepositoryInterface;
use App\Http\Controllers\Controller;

class OrderCommentaryController extends Controller
{
    private $orderCommentaryInterface;
    private $orderStatusesLogInterface;

    public function __construct(
        OrderCommentaryRepositoryInterface $orderCommentaryRepositoryInterface,
        OrderStatusesLogRepositoryInterface $orderStatusesLogRepositoryInterface
    ) {
        $this->orderCommentaryInterface  = $orderCommentaryRepositoryInterface;
        $this->orderStatusesLogInterface = $orderStatusesLogRepositoryInterface;
        $this->middleware(['permission:customers, guard:employee']);
    }

    public function store(CreateOrderCommentaryRequest $request)
    {
        $user = auth()->guard('employee')->user();
        $request['user'] = $user->name;
        $commentary =  $this->customerCommentaryInterface->createOrderCommentary($request->except('_token', '_method'));

        $data = array(
            'customer_id' => $commentary->customer->id,
            'status'      => 'Comentario Agregado',
            'employee_id' => $user->id
        );

        $this->customerStatusesLogInterface->createCustomerStatusesLog($data);

        $request->session()->flash('message', config('messaging.create'));
        return back();
    }
}
