<?php

namespace Modules\Customers\Http\Controllers\Admin\CustomerEpss;

use Modules\Customers\Entities\CustomerEpss\Repositories\Interfaces\CustomerEpsRepositoryInterface;
use Modules\Customers\Entities\CustomerEpss\Requests\CreateCustomerEpsRequest;
use App\Http\Controllers\Controller;
use Modules\Customers\Entities\CustomerStatusesLogs\Repositories\Interfaces\CustomerStatusesLogRepositoryInterface;

class CustomerEpsController extends Controller
{
    private $customerEpsInterface, $customerStatusesLogInterface;

    public function __construct(
        CustomerEpsRepositoryInterface $customerEpsRepositoryInterface,
        CustomerStatusesLogRepositoryInterface $customerStatusesLogRepositoryInterface
    ) {
        $this->customerEpsInterface = $customerEpsRepositoryInterface;
        $this->customerStatusesLogInterface = $customerStatusesLogRepositoryInterface;
        $this->middleware(['permission:customers, guard:employee']);
    }

    public function store(CreateCustomerEpsRequest $request)
    {
        $eps = $this->customerEpsInterface->createCustomerEps($request->except('_token', '_method'));
        $data = array(
            'customer_id' => $eps->customer->id,
            'status'      => 'Eps Agregada',
            'employee_id' => auth()->guard('employee')->user()->id
        );

        $this->customerStatusesLogInterface->createCustomerStatusesLog($data);

        $request->session()->flash('message', config('messaging.create'));
        return back();
    }
}
