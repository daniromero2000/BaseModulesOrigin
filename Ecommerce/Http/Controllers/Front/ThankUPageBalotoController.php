<?php

namespace Modules\Ecommerce\Http\Controllers\Front;

use Modules\Ecommerce\Entities\Couriers\Repositories\Interfaces\CourierRepositoryInterface;
use Modules\Customers\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use Modules\Ecommerce\Entities\Orders\Transformers\OrderTransformable;
use App\Http\Controllers\Controller;

class ThankUPageBalotoController extends Controller
{
    use OrderTransformable;
    private $customerRepo, $courierRepo;

    public function __construct(
        CourierRepositoryInterface $courierRepository,
        CustomerRepositoryInterface $customerRepository
    ) {
        $this->customerRepo = $customerRepository;
        $this->courierRepo  = $courierRepository;
    }

    public function index()
    {
        return view('ecommerce::front.thank_u_page_baloto', [
            'order' =>  request()->input('order'),
            'total' => request()->input('total')
        ]);
    }
}
