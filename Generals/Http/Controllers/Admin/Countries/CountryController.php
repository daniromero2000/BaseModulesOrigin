<?php

namespace Modules\Generals\Http\Controllers\Admin\Countries;

use Modules\Generals\Entities\Countries\Repositories\CountryRepository;
use Modules\Generals\Entities\Countries\Repositories\Interfaces\CountryRepositoryInterface;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    private $countryInterface;

    public function __construct(
        CountryRepositoryInterface $countryRepositoryInterface
    ) {
        dd('entre');
        $this->countryInterface = $countryRepositoryInterface;
    }

    public function index()
    {

        dd('entre a index');
        return view('generals::admin.countries.list', [
            'countries' =>  $this->countryInterface->listCountries()
        ]);
    }

    public function show(int $id)
    {
        $country     = $this->countryInterface->findCountryById($id);
        $countryRepo = new CountryRepository($country);

        return view('generals::admin.countries.show', [
            'country'   => $country,
            'provinces' => $countryRepo->findProvinces()->toArray()
        ]);
    }
}
