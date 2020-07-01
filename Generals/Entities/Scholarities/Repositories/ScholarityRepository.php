<?php

namespace Modules\Generals\Entities\Scholarities\Repositories;

use Modules\Generals\Entities\Scholarities\Scholarity;
use Modules\Generals\Entities\Scholarities\Repositories\Interfaces\ScholarityRepositoryInterface;
use Illuminate\Database\QueryException;

class ScholarityRepository implements ScholarityRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'scholarity'];

    public function __construct(
        Scholarity $Scholarity
    ) {
        $this->model = $Scholarity;
    }

    public function getAllScholaritiesNames()
    {
        try {
            return $this->model->orderBy('scholarity', 'asc')
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
