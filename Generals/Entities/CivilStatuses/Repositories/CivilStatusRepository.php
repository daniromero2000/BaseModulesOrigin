<?php

namespace Modules\Generals\Entities\CivilStatuses\Repositories;

use Modules\Generals\Entities\CivilStatuses\CivilStatus;
use Modules\Generals\Entities\CivilStatuses\Repositories\Interfaces\CivilStatusRepositoryInterface;
use Illuminate\Database\QueryException;

class CivilStatusRepository implements CivilStatusRepositoryInterface
{
    protected $model;
    private $columns = [];

    public function __construct(
        CivilStatus $CivilStatus
    ) {
        $this->model = $CivilStatus;
    }

    public function getAllCivilStatusesNames()
    {
        try {
            return $this->model->orderBy('civil_status', 'asc')
                ->get(['id', 'civil_status']);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
