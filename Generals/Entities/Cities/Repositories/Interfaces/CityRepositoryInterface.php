<?php

namespace Modules\Generals\Entities\Cities\Repositories\Interfaces;

use Modules\Generals\Entities\Cities\City;

interface CityRepositoryInterface
{
    public function getAllCityNames();

    public function listCities();

    public function listCitiesFront();

    public function listCitiesForColumns($columns);

    public function listCitiesForLeads($columns);

    public function findCityById(int $id): City;

    public function findCityByCode(int $id);

    public function findCityByName(string $name): City;

    public function findCityByProvince(int $id);
}
