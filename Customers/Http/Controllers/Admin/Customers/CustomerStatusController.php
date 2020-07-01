<?php

namespace Modules\Customers\Http\Controllers\Admin\Customers;


use Modules\Customers\Entities\CustomerStatuses\Repositories\Interfaces\CustomerStatusRepositoryInterface;
use Modules\Customers\Entities\CustomerStatuses\Repositories\CustomerStatusRepository;
use Modules\Customers\Entities\CustomerStatuses\Requests\CreateCustomerStatusRequest;
use Modules\Customers\Entities\CustomerStatuses\Requests\UpdateCustomerStatusRequest;
use App\Http\Controllers\Controller;

class CustomerStatusController extends Controller
{
    private $customerStatusesInterface;

    public function __construct(
        CustomerStatusRepositoryInterface $customerStatusRepositoryInterface
    ) {
        $this->customerStatusesInterface = $customerStatusRepositoryInterface;
        $this->middleware(['permission:customers, guard:employee']);
    }

    public function index()
    {
        return view('customers::admin.customer-statuses.list', [
            'customerStatuses' => $this->customerStatusesInterface->listCustomerStatuses(),
            'user'             => auth()->guard('employee')->user(),
            'optionsRoutes' => 'admin.' . (request()->segment(2)),
            'headers'       => ['ID', 'Nombre', 'Color', 'Opciones']
        ]);
    }

    public function create()
    {
        return view('customers::admin.customer-statuses.create');
    }

    public function store(CreateCustomerStatusRequest $request)
    {
        if(!strpos($request['color'], '#')){
            $request['color'] = '#'.$request['color'];
        }

        $this->customerStatusesInterface->createCustomerStatus($request->except('_token', '_method'));
        $request->session()->flash('message', config('messaging.create'));
        return redirect()->route('admin.customer-statuses.index');
    }

    public function edit(int $id)
    {
        return view('customers::admin.customer-statuses.edit', [
            'customerStatus' => $this->customerStatusesInterface->findCustomerStatusById($id)
        ]);
    }

    public function update(UpdateCustomerStatusRequest $request, int $id)
    {
        $update = new CustomerStatusRepository($this->customerStatusesInterface->findCustomerStatusById($id));
        $update->updateCustomerStatus($request->all());
        $request->session()->flash('message', config('messaging.update'));

        return redirect()->route('admin.customer-statuses.edit', $id);
    }

    public function destroy(int $id)
    {
        $customerStatus = new CustomerStatusRepository($this->customerStatusesInterface->findCustomerStatusById($id));
        $customerStatus->deleteCustomerStatus();

        request()->session()->flash('message', 'Eliminado Satisfactoriamente');
        return redirect()->route('admin.customer-statuses.index');
    }
}
