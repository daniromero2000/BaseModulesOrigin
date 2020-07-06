<?php

namespace Modules\Customers\Http\Controllers\Admin\CustomerPhones;

use Modules\Customers\Entities\CustomerPhones\Repositories\Interfaces\CustomerPhoneRepositoryInterface;
use Modules\Customers\Entities\CustomerPhones\Requests\CreateCustomerPhoneRequest;
use App\Http\Controllers\Controller;
use Modules\Customers\Entities\CustomerStatusesLogs\Repositories\Interfaces\CustomerStatusesLogRepositoryInterface;

class CustomerPhoneController extends Controller
{
    private $customerPhoneInterface, $customerStatusesLogInterface;

    public function __construct(
        CustomerPhoneRepositoryInterface $customerPhoneRepositoryInterface,
        CustomerStatusesLogRepositoryInterface $customerStatusesLogRepositoryInterface
    ) {
        $this->customerPhoneInterface       = $customerPhoneRepositoryInterface;
        $this->customerStatusesLogInterface = $customerStatusesLogRepositoryInterface;
        $this->middleware(['permission:customers, guard:employee']);
    }

    public function store(CreateCustomerPhoneRequest $request)
    {
        $phone = $this->customerPhoneInterface->createCustomerPhone($request->except('_token', '_method'));
        $data = array(
            'customer_id' => $phone->customer->id,
            'status'      => 'Teléfono Agregado',
            'employee_id' => auth()->guard('employee')->user()->id
        );

        $this->customerStatusesLogInterface->createCustomerStatusesLog($data);
        $request->session()->flash('message', config('messaging.create'));
        return back();
    }
}
