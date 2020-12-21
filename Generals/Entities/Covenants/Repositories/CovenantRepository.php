<?php

namespace Modules\Generals\Entities\Covenants\Repositories;

use Modules\Generals\Entities\Covenants\Covenant;
use Modules\Generals\Entities\Covenants\Repositories\Interfaces\CovenantRepositoryInterface;
use Illuminate\Database\QueryException;

class CovenantRepository implements CovenantRepositoryInterface
{
    protected $model;
    private $columns = [];

    public function __construct(
        Covenant $Covenant
    ) {
        $this->model = $Covenant;
    }

    public function getAllCovenantsNames()
    {
        try {
            return $this->model->orderBy('covenant', 'asc')
                ->get(['id', 'covenant']);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
