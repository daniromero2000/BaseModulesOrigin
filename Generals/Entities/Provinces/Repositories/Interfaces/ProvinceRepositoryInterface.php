<?php

namespace Modules\Generals\Entities\Provinces\Repositories\Interfaces;

use Modules\Generals\Entities\Countries\Country;
use Modules\Generals\Entities\Provinces\Province;
use Illuminate\Support\Collection;

interface ProvinceRepositoryInterface
{
    public function listProvinces(string $order = 'id', string $sort = 'desc', array $columns = ['*']): Collection;

    public function findProvinceById(int $id): Province;

    public function updateProvince(array $params): bool;

    public function listCities(int $provinceId);

    public function findCountry(): Country;
}
