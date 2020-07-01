<?php

namespace Modules\Ecommerce\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Modules\Customers\Entities\CustomerAddresses\UpdateAddressRequest;
use Modules\Customers\Entities\CustomerAddresses\Repositories\AddressRepository;
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
        $customer = auth()->user();

        return view('ecommerce::front.customers.addresses.create', [
            'customer' => $customer,
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

        return redirect()->route('accounts', ['tab' => 'address'])
            ->with('message', config('messaging.create'));
    }

    public function edit($customerId, $addressId)
    {
        $address = $this->addressRepo->findCustomerAddressById($addressId, auth()->user());

        return view('ecommerce::front.customers.addresses.edit', [
            'customer' => auth()->user(),
            'address' => $address,
            'cities' => $this->cityRepo->listCities(),
            'provinces' => $this->provinceRepo->listProvinces()
        ]);
    }

    public function update(UpdateAddressRequest $request, $customerId, $addressId)
    {
        $address = $this->addressRepo->findCustomerAddressById($addressId, auth()->user());
        $request = $request->except('_token', '_method');
        $request['customer_id'] = auth()->user()->id;
        $addressRepo = new AddressRepository($address);
        $addressRepo->updateAddress($request);

        return redirect()->route('accounts', ['tab' => 'address'])
            ->with('message', config('messaging.update'));
    }

    public function destroy($customerId, $addressId)
    {
        $address = $this->addressRepo->findCustomerAddressById($addressId, auth()->user());

        if ($address->orders()->exists()) {
            $address->status = 0;
            $address->save();
        } else {
            $address->delete();
        }
        return redirect()->route('accounts', ['tab' => 'address'])
            ->with('message', config('messaging.delete'));
    }
}
