<?php

namespace Modules\Customers\Http\Controllers\Admin\CustomerIdentities;

use Modules\Customers\Entities\CustomerIdentities\Repositories\Interfaces\CustomerIdentityRepositoryInterface;
use Modules\Customers\Entities\CustomerIdentities\Requests\CreateCustomerIdentityRequest;
use App\Http\Controllers\Controller;
use Modules\Customers\Entities\CustomerStatusesLogs\Repositories\Interfaces\CustomerStatusesLogRepositoryInterface;

class CustomerIdentityController extends Controller
{
    private $customerIdentityInterface, $customerStatusesLogInterface;

    public function __construct(
        CustomerIdentityRepositoryInterface $customerIdentityRepositoryInterface,
        CustomerStatusesLogRepositoryInterface $customerStatusesLogRepositoryInterface
    ) {
        $this->customerIdentityInterface = $customerIdentityRepositoryInterface;
        $this->customerStatusesLogInterface = $customerStatusesLogRepositoryInterface;
        $this->middleware(['permission:customers, guard:employee']);
    }

    public function store(CreateCustomerIdentityRequest $request)
    {
        $identity = $this->customerIdentityInterface->createCustomerIdentity($request->except('_token', '_method'));
        $data = array(
            'customer_id' => $identity->customer->id,
            'status'      => 'Identidad Agregada',
            'employee_id' => auth()->guard('employee')->user()->id
        );

        $this->customerStatusesLogInterface->createCustomerStatusesLog($data);
        $request->session()->flash('message', config('messaging.create'));
        return back();
    }
}
