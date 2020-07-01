<?php

namespace Modules\Customers\Http\Controllers\Admin\CustomerCommentaries;

use Modules\Customers\Entities\CustomerCommentaries\Repositories\Interfaces\CustomerCommentaryRepositoryInterface;
use Modules\Customers\Entities\CustomerCommentaries\Requests\CreateCustomerCommentaryRequest;
use Modules\Customers\Entities\CustomerStatusesLogs\Repositories\Interfaces\CustomerStatusesLogRepositoryInterface;
use App\Http\Controllers\Controller;

class CustomerCommentaryController extends Controller
{
    private $customerCommentaryInterface;
    private $customerStatusesLogInterface;

    public function __construct(
        CustomerCommentaryRepositoryInterface $customerCommentaryRepositoryInterface,
        CustomerStatusesLogRepositoryInterface $customerStatusesLogRepositoryInterface
    ) {
        $this->customerCommentaryInterface  = $customerCommentaryRepositoryInterface;
        $this->customerStatusesLogInterface = $customerStatusesLogRepositoryInterface;
        $this->middleware(['permission:customers, guard:employee']);
    }

    public function store(CreateCustomerCommentaryRequest $request)
    {
        $user = auth()->guard('employee')->user();
        $request['user'] = $user->name;
        $commentary =  $this->customerCommentaryInterface->createCustomerCommentary($request->except('_token', '_method'));

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
