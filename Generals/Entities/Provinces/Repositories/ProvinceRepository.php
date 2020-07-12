<?php

namespace Modules\Generals\Entities\Provinces\Repositories;

use Modules\Generals\Entities\Countries\Country;
use Modules\Generals\Entities\Provinces\Province;
use Modules\Generals\Entities\Provinces\Repositories\Interfaces\ProvinceRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;

class ProvinceRepository implements ProvinceRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'dane', 'province', 'country_id', 'is_active'];

    public function __construct(Province $province)
    {
        $this->model = $province;
    }

    public function listProvinces(string $order = 'province', string $sort = 'desc', array $columns = ['*']): Collection
    {
        return $this->model->all($this->columns, $order, $sort);
    }

    public function findProvinceById(int $id): Province
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateProvince(array $params): bool
    {
        try {
            return $this->model->update($params);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listCities(int $provinceId): Collection
    {
        return $this->findProvinceById($provinceId)->cities()->get();
    }

    public function findCountry(): Country
    {
        return $this->model->country;
    }
}
