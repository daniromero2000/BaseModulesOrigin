<?php

namespace Modules\Generals\Entities\Countries\Repositories\Interfaces;

use Modules\Generals\Entities\Countries\Country;
use Illuminate\Support\Collection;

interface CountryRepositoryInterface
{
  public function listCountries(): Collection;

  public function findCountryById(int $id): Country;

  public function findProvinces();
}
