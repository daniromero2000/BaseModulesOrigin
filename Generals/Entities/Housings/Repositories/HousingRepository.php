<?php

namespace Modules\Generals\Entities\Housings\Repositories;

use Modules\Generals\Entities\Housings\Housing;
use Modules\Generals\Entities\Housings\Repositories\Interfaces\HousingRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Modules\Generals\Entities\Housings\Exceptions\HousingNotFoundException;

class HousingRepository implements HousingRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'housing'];

    public function __construct(
        Housing $housing
    ) {
        $this->model = $housing;
    }

    public function listHousings()
    {
        try {
            return $this->model->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getAllHousingsNames()
    {
        try {
            return $this->model->orderBy('housing', 'asc')
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
