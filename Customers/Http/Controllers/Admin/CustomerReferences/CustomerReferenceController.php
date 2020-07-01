<?php

namespace Modules\Customers\Http\Controllers\Admin\CustomerReferences;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Customers\Entities\CustomerReferences\Requests\CreateCustomerReferenceRequest;
use Modules\Customers\Entities\CustomerReferences\Repositories\Interfaces\CustomerReferenceRepositoryInterface;
use Modules\Customers\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use Modules\Customers\Entities\CustomerStatusesLogs\Repositories\Interfaces\CustomerStatusesLogRepositoryInterface;
use Modules\Customers\Entities\CustomerPhones\Repositories\Interfaces\CustomerPhoneRepositoryInterface;

class CustomerReferenceController extends Controller
{
    private $customerReferenceInterface, $customerInterface, $customerPhoneInterface, $customerStatusesLogInterface;

    public function __construct(
        CustomerReferenceRepositoryInterface $customerReferenceRepositoryInterface,
        CustomerRepositoryInterface $customerRepositoryInterface,
        CustomerStatusesLogRepositoryInterface $customerStatusesLogRepositoryInterface,
        CustomerPhoneRepositoryInterface $customerPhoneRepositoryInterface
    ) {
        $this->customerReferenceInterface   = $customerReferenceRepositoryInterface;
        $this->customerInterface            = $customerRepositoryInterface;
        $this->customerStatusesLogInterface = $customerStatusesLogRepositoryInterface;
        $this->customerPhoneInterface       = $customerPhoneRepositoryInterface;
        $this->middleware(['permission:customers, guard:employee']);
    }

    public function index()
    {
        return view('customers::index');
    }

    public function create()
    {
        return view('customers::create');
    }

    public function store(CreateCustomerReferenceRequest $request)
    {
        // dd($request);
        $requestData = $request->except('_token', '_method');

        if (empty($customerPhone  = $this->customerPhoneInterface->checkIfExists($request['phone']))) {
            $requestData['customer_channel_id']   = 9;
            $requestData['customer_status_id'] = 3;
            $customer                          = $this->customerInterface->createCustomer($requestData);

            $customerStatusesLog = array(
                'customer_id' => $customer->id,
                'status'      => 'Creado',
                'employee_id' => auth()->guard('employee')->user()->id
            );

            $this->customerStatusesLogInterface->createCustomerStatusesLog($customerStatusesLog);

            $customerPhoneData                = $requestData;
            $customerPhoneData['customer_id'] = $customer->id;
            $customerPhoneData['phone_type']  = 'Móvil';
            $customerPhone                    = $this->customerPhoneInterface->createCustomerPhone($customerPhoneData);
        }

        $customerReference = array(
            'customer_id'       => $requestData['customer_id'],
            'relationship_id'   => $requestData['relationship_id'],
            'customer_phone_id' => $customerPhone->id
        );

        $reference = $this->customerReferenceInterface->createCustomerReference($customerReference);

        $data = array(
            'customer_id' => $reference->customer->id,
            'status'      => 'Referencia Agregada',
            'employee_id' => auth()->guard('employee')->user()->id
        );

        $this->customerStatusesLogInterface->createCustomerStatusesLog($data);

        $request->session()->flash('message', config('messaging.create'));
        return back();
    }

    public function show($id)
    {
        return view('customers::show');
    }

    public function edit($id)
    {
        return view('customers::edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
