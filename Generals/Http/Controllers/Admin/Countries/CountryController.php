<?php

namespace App\Http\Controllers\Admin\Countries;

use Modules\Generals\Entities\Countries\Repositories\CountryRepository;
use Modules\Generals\Entities\Countries\Repositories\Interfaces\CountryRepositoryInterface;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    private $countryInterface;

    public function __construct(CountryRepositoryInterface $countryRepositoryInterface)
    {
        $this->countryInterface = $countryRepositoryInterface;
        $this->middleware(['permission:countries, guard:employee']);
    }

    public function index()
    {
        return view('admin.countries.list', [
            'countries' =>  $this->countryInterface->listCountries()
        ]);
    }

    public function show(int $id)
    {
        $country     = $this->countryInterface->findCountryById($id);
        $countryRepo = new CountryRepository($country);

        return view('admin.countries.show', [
            'country'   => $country,
            'provinces' => $countryRepo->findProvinces()->toArray()
        ]);
    }
}
