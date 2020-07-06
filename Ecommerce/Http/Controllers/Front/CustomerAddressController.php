<?php

namespace Modules\Ecommerce\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Modules\Customers\Entities\CustomerAddresses\Repositories\Interfaces\CustomerAddressRepositoryInterface;
use Modules\Customers\Entities\CustomerAddresses\Requests\CreateCustomerAddressRequest;
use Modules\Generals\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use Modules\Generals\Entities\Countries\Repositories\Interfaces\CountryRepositoryInterface;
use Modules\Generals\Entities\Provinces\Repositories\Interfaces\ProvinceRepositoryInterface;


class CustomerAddressController extends Controller
{
    private $addressRepo, $countryRepo, $cityRepo, $provinceRepo;

    public function __construct(
        CustomerAddressRepositoryInterface $addressRepository,
        CityRepositoryInterface $cityRepository,
        CountryRepositoryInterface $countryRepository,
        ProvinceRepositoryInterface $provinceRepository
    ) {
        $this->addressRepo = $addressRepository;
        $this->provinceRepo = $provinceRepository;
        $this->countryRepo = $countryRepository;
        $this->cityRepo = $cityRepository;
    }

    public function index()
    {
        return redirect()->route('accounts', ['tab' => 'address']);
    }

    public function create()
    {
        return view('ecommerce::front.customers.addresses.create', [
            'customer' => auth()->user(),
            'countries' => $this->countryRepo->listCountries(),
            'cities' => $this->cityRepo->listCities(),
            'provinces' => $this->provinceRepo->listProvinces()
        ]);
    }

    public function store(CreateCustomerAddressRequest $request)
    {
        $request['customer_id'] = auth()->user()->id;
        $request['housing_id'] = 1;
        $request['stratum_id'] = 1;
        $request['city_id'] = 1;
        $request['time_living'] = 1;

        $this->addressRepo->createCustomerAddress($request->except('_token', '_method'));


        return redirect()->route('checkout.index')
            ->with('message', config('messaging.create'));
    }
}
