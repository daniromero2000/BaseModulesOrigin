<?php

namespace Modules\CamStudio\Entities\CammodelBannedCountries\Repositories;

use Illuminate\Database\QueryException;
use Modules\CamStudio\Entities\CammodelBannedCountries\CammodelBannedCountry;
use Modules\CamStudio\Entities\CammodelBannedCountries\Repositories\Interfaces\CammodelBannedCountryInterface;
use Modules\CamStudio\Entities\CammodelBannedCountries\Exceptions\CreateCammodelBannedCountryErrorException;
use Illuminate\Support\Collection;


class CammodelBannedCountryRepository implements CammodelBannedCountryInterface
{
    protected $model;
    private $columns = [
        'id',
        'country_id',
        'cammodel_id',
    ];

    public function __construct(CammodelBannedCountry $cammodelBannedCountry)
    {
        $this->model = $cammodelBannedCountry;
    }

    public function createCammodelBannedCountry(array $data): CammodelBannedCountry
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateCammodelBannedCountryErrorException($e);
        }
    }

    public function listCammodelBannedCountryies(): Collection
    {
        return $this->model->get($this->columns);
    }


}
