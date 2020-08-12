<?php

namespace Modules\Generals\Http\Controllers\Admin\Provinces;

use Modules\Generals\Entities\Provinces\Repositories\Interfaces\ProvinceRepositoryInterface;
use App\Http\Controllers\Controller;

class ProvinceController extends Controller
{
    protected $provinceInterface;

    public function __construct(
        ProvinceRepositoryInterface $provinceRepositoryInterface
    ) {
        $this->provinceInterface = $provinceRepositoryInterface;
    }

    public function show(int $countryId, int $provinceId)
    {
        return view('generals::admin.provinces.show', [
            'province'  => $this->provinceInterface->findProvinceById($provinceId),
            'countryId' => $countryId,
            'cities'    => $this->provinceInterface->listCities($provinceId)->toArray()
        ]);
    }
}
