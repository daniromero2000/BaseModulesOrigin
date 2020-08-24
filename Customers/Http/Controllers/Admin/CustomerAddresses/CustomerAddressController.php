<?php

namespace Modules\Customers\Http\Controllers\Admin\CustomerAddresses;

use Modules\Customers\Entities\CustomerAddresses\Repositories\Interfaces\CustomerAddressRepositoryInterface;
use Modules\Customers\Entities\CustomerAddresses\Requests\CreateCustomerAddressRequest;
use App\Http\Controllers\Controller;
use Modules\Customers\Entities\CustomerStatusesLogs\Repositories\Interfaces\CustomerStatusesLogRepositoryInterface;

class CustomerAddressController extends Controller
{
    private $customerAddressInterface, $customerStatusesLogInterface;

    public function __construct(
        CustomerAddressRepositoryInterface $customerAddressRepositoryInterface,
        CustomerStatusesLogRepositoryInterface $customerStatusesLogRepositoryInterface
    ) {
        $this->customerAddressInterface     = $customerAddressRepositoryInterface;
        $this->customerStatusesLogInterface = $customerStatusesLogRepositoryInterface;
        $this->middleware(['permission:customers, guard:employee']);
    }

    public function store(CreateCustomerAddressRequest $request)
    {
        $address =  $this->customerAddressInterface->createCustomerAddress($request->except('_token', '_method'));
        $data = array(
            'customer_id' => $address->customer->id,
            'status'      => 'Residencia Agregada',
            'employee_id' => auth()->guard('employee')->user()->id
        );

        $this->customerStatusesLogInterface->createCustomerStatusesLog($data);

        $request->session()->flash('message', config('messaging.create'));
        return back();
        
    }
}
