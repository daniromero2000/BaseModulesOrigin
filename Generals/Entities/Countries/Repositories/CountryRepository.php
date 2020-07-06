<?php

namespace Modules\Generals\Entities\Countries\Repositories;

use Modules\Generals\Entities\Countries\Repositories\Interfaces\CountryRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Modules\Generals\Entities\Countries\Country;
use Illuminate\Support\Collection;

class CountryRepository implements CountryRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'name', 'iso', 'iso3', 'numcode', 'phonecode', 'is_active'];

    public function __construct(Country $country)
    {
        $this->model = $country;
    }

    public function listCountries(): Collection
    {
        try {
            return $this->model->where('is_active', 1)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findCountryById(int $id): Country
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findProvinces()
    {
        try {
            return $this->model->provinces;
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
