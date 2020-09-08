<?php

namespace Modules\CamStudio\Entities\CammodelBannedCountries\Repositories\Interfaces;

use Illuminate\Support\Collection;

use Modules\CamStudio\Entities\CammodelBannedCountries\CammodelBannedCountry;

interface CammodelBannedCountryInterface
{
    public function createCammodelBannedCountry(array $data): CammodelBannedCountry;
    public function listCammodelBannedCountryies(): Collection;
}
