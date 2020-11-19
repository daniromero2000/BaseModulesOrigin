<?php

namespace Modules\Generals\Entities\Cities\Repositories;

use Modules\Generals\Entities\Cities\City;
use Modules\Generals\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class CityRepository implements CityRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'city', 'is_active_leads', 'province_id'];

    public function __construct(City $city)
    {
        $this->model = $city;
    }

    public function getAllCityNames()
    {
        try {
            return $this->model->orderBy('city', 'asc')
                ->get(['id', 'city']);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listCitiesFront()
    {
        try {
            return $this->model->orderBy('city', 'asc')
                ->groupBy('city')
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listCities()
    {
        try {
            return $this->model->orderBy('city', 'asc')
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listCitiesForColumns($columns)
    {
        try {
            return $this->model->orderBy('city', 'asc')
                ->get($columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listCitiesForLeads($columns)
    {
        try {
            return $this->model->orderBy('city', 'asc')
                ->where('is_active_leads', 1)
                ->get($columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findCityById(int $id): City
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findCityByProvince(int $id)
    {
        try {
            return $this->model->where('province_id', $id)->get($this->columns);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findCityByName(string $name): City
    {
        try {
            return $this->model->where(compact('name'))->firstOrFail();
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }
}
